<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('yf_transactions', function (Blueprint $table) {
            // Supprimer l'ancienne FK qui pointait vers beneficiaries
            $table->dropForeign(['beneficiary_id']);

            // Renommer la colonne pour refléter la réalité
            $table->renameColumn('beneficiary_id', 'yf_recipient_id');
        });

        Schema::table('yf_transactions', function (Blueprint $table) {
            // Ajouter la bonne FK vers yf_recipients
            $table->foreign('yf_recipient_id')
                  ->references('id')
                  ->on('yf_recipients')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('yf_transactions', function (Blueprint $table) {
            $table->dropForeign(['yf_recipient_id']);
            $table->renameColumn('yf_recipient_id', 'beneficiary_id');
        });

        Schema::table('yf_transactions', function (Blueprint $table) {
            $table->foreign('beneficiary_id')
                  ->references('id')
                  ->on('beneficiaries')
                  ->onDelete('restrict');
        });
    }
};
