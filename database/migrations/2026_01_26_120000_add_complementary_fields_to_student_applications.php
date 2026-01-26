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
        Schema::table('student_applications', function (Blueprint $table) {
            // Type de dossier : nouveau (initial) ou complementaire
            $table->enum('dossier_type', ['nouveau', 'complementaire'])->default('nouveau')->after('passport_number');

            // Champs pour le dossier complémentaire
            $table->string('visa_current')->nullable()->after('dossier_type');
            $table->boolean('casier_judiciaire_valide')->default(false)->after('visa_current');
            $table->string('bilan_sante_chinois_path')->nullable()->after('casier_judiciaire_valide');
            $table->text('complement_application')->nullable()->after('bilan_sante_chinois_path');
            $table->string('numero_chinois')->nullable()->after('complement_application');

            // Statut du dossier complémentaire
            $table->enum('complementary_status', ['not_started', 'in_progress', 'submitted', 'approved', 'rejected'])->default('not_started')->after('numero_chinois');
            $table->timestamp('complementary_submitted_at')->nullable()->after('complementary_status');

            // Étape actuelle du dossier (pour tracking de progression)
            $table->unsignedTinyInteger('current_step')->default(1)->after('complementary_submitted_at');

            // Informations complémentaires de l'étudiant
            $table->string('university_name')->nullable()->after('current_step');
            $table->string('field_of_study')->nullable()->after('university_name');
            $table->year('admission_year')->nullable()->after('field_of_study');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_applications', function (Blueprint $table) {
            $table->dropColumn([
                'dossier_type',
                'visa_current',
                'casier_judiciaire_valide',
                'bilan_sante_chinois_path',
                'complement_application',
                'numero_chinois',
                'complementary_status',
                'complementary_submitted_at',
                'current_step',
                'university_name',
                'field_of_study',
                'admission_year',
            ]);
        });
    }
};
