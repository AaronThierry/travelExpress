<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exchange_rates', function (Blueprint $table) {
            $table->decimal('change_percentage', 6, 2)->default(0.00)->after('rate');
            $table->enum('trend', ['up', 'down', 'stable'])->default('stable')->after('change_percentage');
        });
    }

    public function down(): void
    {
        Schema::table('exchange_rates', function (Blueprint $table) {
            $table->dropColumn(['change_percentage', 'trend']);
        });
    }
};
