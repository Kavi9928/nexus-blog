<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add 'pending' (submitted, awaiting admin review) and 'rejected' to the status enum.
        DB::statement("ALTER TABLE posts MODIFY COLUMN status ENUM('draft', 'pending', 'published', 'rejected', 'scheduled') NOT NULL DEFAULT 'draft'");
    }

    public function down(): void
    {
        DB::statement("UPDATE posts SET status = 'draft' WHERE status IN ('pending', 'rejected')");
        DB::statement("ALTER TABLE posts MODIFY COLUMN status ENUM('draft', 'published', 'scheduled') NOT NULL DEFAULT 'draft'");
    }
};
