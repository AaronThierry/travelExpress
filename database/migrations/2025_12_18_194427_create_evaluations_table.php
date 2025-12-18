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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Informations personnelles
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();

            // Informations académiques
            $table->string('university');
            $table->string('country_of_study');
            $table->enum('study_level', [
                'licence_1', 'licence_2', 'licence_3',
                'master_1', 'master_2',
                'doctorat',
                'formation_professionnelle',
                'autre'
            ]);
            $table->string('field_of_study'); // Filière
            $table->year('start_year')->nullable(); // Année de début des études

            // Expérience avec Travel Express
            $table->enum('service_used', [
                'etudes',
                'business',
                'tourisme',
                'visa_seul',
                'autre'
            ])->default('etudes');
            $table->text('project_story'); // Comment avez-vous réalisé votre projet de voyage

            // Comment avez-vous connu Travel Express
            $table->enum('discovery_source', [
                'ambassadeur_la_bobolaise',
                'ambassadeur_ley_ley',
                'ambassadeur_autre',
                'facebook',
                'tiktok',
                'instagram',
                'youtube',
                'bouche_a_oreille',
                'site_web',
                'evenement',
                'autre'
            ]);
            $table->string('discovery_source_detail')->nullable(); // Détail si "autre" ou nom ambassadeur

            // Évaluation
            $table->unsignedTinyInteger('rating')->default(5); // Note de 1 à 5
            $table->unsignedTinyInteger('rating_accompagnement')->nullable(); // Note accompagnement
            $table->unsignedTinyInteger('rating_communication')->nullable(); // Note communication
            $table->unsignedTinyInteger('rating_delais')->nullable(); // Note respect des délais
            $table->unsignedTinyInteger('rating_rapport_qualite_prix')->nullable(); // Rapport qualité/prix

            // Recommandation
            $table->boolean('would_recommend')->default(true);
            $table->text('comment')->nullable(); // Commentaire libre

            // Témoignage public (optionnel)
            $table->text('public_testimonial')->nullable();
            $table->boolean('allow_public_display')->default(false);
            $table->boolean('allow_photo_display')->default(false);

            // Statut
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
