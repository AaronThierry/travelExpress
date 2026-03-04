<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // TEXT (65 535 chars) is too small for base64 PNG signatures (~80 000+ chars)
        // LONGTEXT supports up to 4 GB
        DB::statement('ALTER TABLE evaluations MODIFY COLUMN signature LONGTEXT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE evaluations MODIFY COLUMN signature TEXT NULL');
    }
};
