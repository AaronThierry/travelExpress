<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Chemin du binaire Tesseract sur le serveur
    |--------------------------------------------------------------------------
    | À installer sur le VPS : apt install tesseract-ocr tesseract-ocr-fra
    | Vérifier le chemin avec `which tesseract` une fois installé.
    */
    'tesseract_binary' => env('TESSERACT_PATH', '/usr/bin/tesseract'),
    'tesseract_lang'   => 'fra',

    /*
    |--------------------------------------------------------------------------
    | Règles d'extraction — Baccalauréat (Burkina Faso)
    |--------------------------------------------------------------------------
    | Chaque règle est une regex appliquée au texte brut OCR. Le premier
    | groupe capturé devient la valeur du champ. À AJUSTER une fois de vrais
    | scans disponibles : le texte OCR est bruité (accents, sauts de ligne,
    | fautes de reconnaissance), ces patterns sont un point de départ.
    |
    | Ne jamais faire confiance à 100% à ces valeurs sur un document officiel
    | — elles ne servent qu'à pré-remplir le formulaire de relecture staff.
    */
    'bac_patterns' => [
        'nom_complet'    => '/(?:Nom et pr[ée]nom\(?s?\)?|Titulaire)\s*[:\-]?\s*([A-ZÀ-Ü][A-Za-zÀ-ÿ\'\-\s]{2,60})/u',
        'date_naissance' => '/n[ée]\(?e?\)?\s+le\s+(\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4})/iu',
        'lieu_naissance' => '/n[ée]\(?e?\)?\s+le\s+\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4}\s+[àa]\s+([A-ZÀ-Ü][A-Za-zÀ-ÿ\'\-\s]{2,40})/iu',
        'serie'          => '/S[ée]rie\s*[:\-]?\s*([A-Z][0-9]?)/iu',
        'session'        => '/Session\s*[:\-]?\s*(\d{4})/iu',
        'mention'        => '/Mention\s*[:\-]?\s*(Passable|Assez[\s\-]Bien|Bien|Tr[èe]s[\s\-]Bien)/iu',
        'moyenne'        => '/Moyenne\s*[:\-]?\s*(\d{1,2}[,\.]\d{1,2})/iu',
        'numero_diplome' => '/N°?\s*(?:du diplôme|d\'ordre)?\s*[:\-]?\s*([A-Z0-9][A-Z0-9\-\/]{3,20})/iu',
    ],
];
