<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('author')->after('email');
            $table->string('username')->nullable()->unique()->after('name');
            $table->string('title')->nullable()->after('role');
            $table->text('bio')->nullable()->after('title');
            $table->string('avatar')->nullable()->after('bio');
            $table->string('twitter')->nullable()->after('avatar');
            $table->string('linkedin')->nullable()->after('twitter');
            $table->string('website')->nullable()->after('linkedin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'username', 'title', 'bio', 'avatar',
                'twitter', 'linkedin', 'website',
            ]);
        });
    }
};
