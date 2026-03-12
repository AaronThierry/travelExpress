<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('application_documents', function (Blueprint $table) {
            $table->boolean('is_complementary')->default(false)->after('status');
        });

        // Backfill existing rows: mark complementary doc types as complementary
        $complementaryTypes = [
            'visa_chinois', 'bilan_sante_chinois', 'casier_judiciaire_chinois',
            'passeport_complet', 'certificat_langue', 'certificat_etude_chinois',
            'formulaire_inscription',
        ];
        \DB::table('application_documents')
            ->whereIn('document_type', $complementaryTypes)
            ->update(['is_complementary' => true]);
    }

    public function down(): void
    {
        Schema::table('application_documents', function (Blueprint $table) {
            $table->dropColumn('is_complementary');
        });
    }
};
