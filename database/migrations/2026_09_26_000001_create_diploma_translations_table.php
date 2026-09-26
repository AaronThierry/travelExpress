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
        Schema::create('diploma_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_application_id')->nullable()
                ->constrained('student_applications')->nullOnDelete();

            // Type de diplôme couvert (on démarre avec le seul baccalauréat)
            $table->string('document_type')->default('baccalaureat');

            // Fichier scanné fourni par l'étudiant
            $table->string('source_scan_path');

            // Résultat brut de l'OCR (Tesseract), pour audit/re-traitement
            $table->longText('ocr_raw_text')->nullable();

            // Champs devinés automatiquement par les règles regex (nom, moyenne, mention...)
            $table->json('extracted_fields')->nullable();

            // Mêmes champs après relecture/correction par le staff — sert de source de vérité
            $table->json('verified_fields')->nullable();

            $table->enum('status', [
                'pending_ocr',      // scan uploadé, OCR pas encore lancé/terminé
                'pending_review',   // OCR fait, en attente de relecture staff
                'reviewed',         // champs validés par le staff
                'generated',        // PDF bilingue généré
                'sent_partner',     // envoyé au partenaire pour certification
                'certified',        // document certifié reçu et archivé
            ])->default('pending_ocr');

            // PDF bilingue généré automatiquement (brouillon, non certifié)
            $table->string('generated_pdf_path')->nullable();

            // Document final certifié/signé renvoyé par le partenaire
            $table->string('certified_pdf_path')->nullable();

            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diploma_translations');
    }
};
