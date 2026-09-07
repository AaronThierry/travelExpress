<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Informations générales du site
    |--------------------------------------------------------------------------
    */
    'site_name'    => 'Travel Express',
    'locale'       => 'fr_FR',

    // URL canonique de production (sans slash final). Vient de APP_URL.
    'base_url'     => rtrim(env('APP_URL', 'https://travels.express'), '/'),

    // Image par défaut pour les partages sociaux (idéal : 1200x630 px)
    'default_image' => '/images/logo/logo_travel.png',

    /*
    |--------------------------------------------------------------------------
    | Meta par défaut (page d'accueil)
    |--------------------------------------------------------------------------
    */
    'default_title'       => "Travel Express — Études, Travail & Business à l'International",
    'default_description' => "Travel Express, votre partenaire à Ouagadougou pour réaliser vos projets à l'international : études, travail et business en Chine, Espagne et Allemagne. Accompagnement personnalisé de A à Z.",

    /*
    |--------------------------------------------------------------------------
    | Coordonnées de l'agence (données structurées LocalBusiness)
    |--------------------------------------------------------------------------
    */
    'business' => [
        'legal_name'   => 'Travel Express',
        'email'        => 'armel.bakoua@travel-express.bf',
        'phone'        => '+22665604592',
        'street'       => 'Ouagadougou',
        'city'         => 'Ouagadougou',
        'region'       => 'Centre',
        'country'      => 'BF',
        'postal_code'  => '',
        'latitude'     => 12.368780,
        'longitude'    => -1.496232,
        'price_range'  => '$$',
        'opening_hours' => [
            ['days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], 'opens' => '08:00', 'closes' => '18:00'],
            ['days' => ['Saturday'], 'opens' => '08:00', 'closes' => '13:00'],
        ],
        // Profils sociaux officiels (renseigner puis dé-commenter les URLs réelles)
        'same_as' => array_filter([
            // 'https://www.facebook.com/...',
            // 'https://www.instagram.com/...',
            // 'https://www.tiktok.com/@travel_express',
        ]),
        'areas_served' => ['Burkina Faso', 'Chine', 'Espagne', 'Allemagne'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pages publiques listées dans le sitemap.xml
    |--------------------------------------------------------------------------
    | 'path' => ['changefreq' => ..., 'priority' => ...]
    */
    'sitemap' => [
        '/'        => ['changefreq' => 'weekly',  'priority' => '1.0'],
        '/bourse'  => ['changefreq' => 'monthly', 'priority' => '0.8'],
    ],
];
