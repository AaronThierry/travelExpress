<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL, we need to modify the enum
        // First change to string to avoid enum restrictions
        Schema::table('evaluations', function (Blueprint $table) {
            $table->string('discovery_source', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum if needed
        Schema::table('evaluations', function (Blueprint $table) {
            $table->string('discovery_source', 50)->change();
        });
    }
};
