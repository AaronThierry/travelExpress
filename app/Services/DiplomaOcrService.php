<?php

namespace App\Services;

use thiagoalessio\TesseractOCR\TesseractOCR;

/**
 * Lit un scan de baccalauréat via Tesseract OCR et en extrait les champs
 * variables (nom, moyenne, mention...) par règles regex.
 *
 * Dépendances côté serveur (non gérées par Composer) :
 *   - binaire `tesseract-ocr` + paquet de langue `fra`
 *     (VPS : apt install tesseract-ocr tesseract-ocr-fra)
 * Dépendance Composer à installer avant utilisation :
 *   - composer require thiagoalessio/tesseract_ocr
 *
 * L'extraction par regex est un pré-remplissage, jamais une source de
 * vérité : un humain doit toujours relire/corriger avant de générer un
 * document officiel (voir DiplomaTranslation::markReviewed()).
 */
class DiplomaOcrService
{
    /**
     * Fait tourner l'OCR sur un fichier image/PDF et retourne le texte brut.
     */
    public function extractText(string $absoluteFilePath): string
    {
        return (new TesseractOCR($absoluteFilePath))
            ->executable(config('diploma_translation.tesseract_binary'))
            ->lang(config('diploma_translation.tesseract_lang'))
            ->run();
    }

    /**
     * Applique les règles regex du baccalauréat sur un texte OCR et retourne
     * les champs devinés (valeur null si la règle ne matche pas).
     */
    public function extractBacFields(string $ocrText): array
    {
        $fields = [];

        foreach (config('diploma_translation.bac_patterns') as $field => $pattern) {
            $fields[$field] = preg_match($pattern, $ocrText, $matches)
                ? trim($matches[1])
                : null;
        }

        return $fields;
    }

    /**
     * Pipeline complet : scan -> texte OCR -> champs devinés.
     * Retourne ['raw_text' => string, 'fields' => array].
     */
    public function process(string $absoluteFilePath): array
    {
        $rawText = $this->extractText($absoluteFilePath);

        return [
            'raw_text' => $rawText,
            'fields'   => $this->extractBacFields($rawText),
        ];
    }
}
