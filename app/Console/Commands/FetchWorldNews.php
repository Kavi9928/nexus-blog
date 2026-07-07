<?php

namespace App\Console\Commands;

use App\Models\NewsItem;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchWorldNews extends Command
{
    protected $signature = 'news:fetch';

    protected $description = 'Fetch the latest tech news headlines from RSS feeds into the news_items table';

    /** @var array<string, string> feed url => source label */
    protected array $feeds = [
        'https://techcrunch.com/feed/' => 'TechCrunch',
        'https://www.theverge.com/rss/index.xml' => 'The Verge',
        'https://feeds.arstechnica.com/arstechnica/index' => 'Ars Technica',
    ];

    public function handle(): int
    {
        $added = 0;

        foreach ($this->feeds as $url => $source) {
            try {
                $response = Http::timeout(15)->get($url);
            } catch (\Throwable $e) {
                $this->warn("Skipping {$source}: {$e->getMessage()}");
                continue;
            }

            if (! $response->ok()) {
                $this->warn("Skipping {$source}: HTTP {$response->status()}");
                continue;
            }

            $xml = @simplexml_load_string($response->body());
            if ($xml === false) {
                $this->warn("Skipping {$source}: could not parse feed");
                continue;
            }

            $isAtom = isset($xml->entry);
            $items = $isAtom ? $xml->entry : ($xml->channel->item ?? []);

            if (count($items) === 0) {
                $this->warn("Skipping {$source}: no items found in feed");
                continue;
            }

            foreach ($items as $item) {
                $title = trim((string) $item->title);

                if ($isAtom) {
                    $link = '';
                    foreach ($item->link as $linkEl) {
                        $rel = (string) $linkEl->attributes()->rel;
                        if ($rel === '' || $rel === 'alternate') {
                            $link = (string) $linkEl->attributes()->href;
                            break;
                        }
                    }
                    $rawDate = (string) ($item->published ?: $item->updated);
                    $rawSummary = (string) ($item->summary ?: $item->content);
                } else {
                    $link = trim((string) $item->link);
                    $rawDate = (string) $item->pubDate;
                    $rawSummary = (string) $item->description;
                }

                $link = trim($link);
                if ($link === '' || $title === '') {
                    continue;
                }

                $publishedAt = null;
                if ($rawDate !== '') {
                    try {
                        $publishedAt = Carbon::parse($rawDate);
                    } catch (\Throwable) {
                        // leave null if the feed sends an unparseable date
                    }
                }

                $wasAdded = NewsItem::firstOrCreate(
                    ['url' => $link],
                    [
                        'title' => Str::limit($title, 250),
                        'source' => $source,
                        'summary' => Str::limit(trim(strip_tags($rawSummary)), 500) ?: null,
                        'published_at' => $publishedAt,
                    ]
                )->wasRecentlyCreated;

                if ($wasAdded) {
                    $added++;
                }
            }
        }

        // keep the table from growing forever — the site only shows the freshest headlines
        NewsItem::orderByDesc('published_at')->skip(200)->take(PHP_INT_MAX)
            ->pluck('id')
            ->whenNotEmpty(fn ($ids) => NewsItem::whereIn('id', $ids)->delete());

        $this->info("Done. {$added} new headlines added, " . NewsItem::count() . ' total.');

        return self::SUCCESS;
    }
}
