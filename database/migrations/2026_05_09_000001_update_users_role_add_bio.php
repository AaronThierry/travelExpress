<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Change role enum to include tailleur instead of employe
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('client','tailleur','admin') NOT NULL DEFAULT 'client'");

        // Add bio column if not exists
        if (!Schema::hasColumn('users', 'bio')) {
            Schema::table('users', function (Blueprint $table) {
                $table->text('bio')->nullable()->after('adresse');
            });
        }
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','employe','client') NOT NULL DEFAULT 'client'");

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bio');
        });
    }
};
