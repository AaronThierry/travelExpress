<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Agrandir la colonne phone pour accepter les emails normalisés (email:user@example.com)
        Schema::table('otp_codes', function (Blueprint $table) {
            $table->string('phone', 191)->change();
        });

        // Rendre max_amount nullable pour le dernier palier (pas de plafond)
        Schema::table('transaction_fees', function (Blueprint $table) {
            $table->decimal('max_amount', 15, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('otp_codes', function (Blueprint $table) {
            $table->string('phone', 20)->change();
        });

        Schema::table('transaction_fees', function (Blueprint $table) {
            $table->decimal('max_amount', 15, 2)->nullable(false)->change();
        });
    }
};
