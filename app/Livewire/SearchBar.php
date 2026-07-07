<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class SearchBar extends Component
{
    public $query = '';
    public $isOpen = false;

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->query = '';
    }

    public function render()
    {
        $results = collect();

        if (strlen($this->query) >= 2) {
            $results = Post::with('category')
                ->published()
                ->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->query . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->query . '%');
                })
                ->take(6)
                ->get();
        }

        return view('livewire.search-bar', [
            'results' => $results,
        ]);
    }
}
