@props([
    'title'       => null,
    'description' => null,
    'image'       => null,
    'type'        => 'website',
    'canonical'   => null,
    'noindex'     => false,
    'organization' => false,  // rendre le JSON-LD LocalBusiness (page d'accueil)
])

@php
    $seoBase   = rtrim(config('seo.base_url'), '/');
    $seoTitle  = $title ?: config('seo.default_title');
    $seoDesc   = $description ?: config('seo.default_description');
    $seoUrl    = $canonical ?: ($seoBase . '/' . ltrim(request()->path() === '/' ? '' : request()->path(), '/'));
    $seoUrl    = rtrim($seoUrl, '/') ?: $seoBase;
    $seoImg    = $image ?: config('seo.default_image');
    if (! \Illuminate\Support\Str::startsWith($seoImg, ['http://', 'https://'])) {
        $seoImg = $seoBase . '/' . ltrim($seoImg, '/');
    }
    $b = config('seo.business');
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDesc }}">
<link rel="canonical" href="{{ $seoUrl }}">

@if($noindex)
    <meta name="robots" content="noindex, nofollow">
@else
    <meta name="robots" content="index, follow, max-image-preview:large">
@endif

{{-- Open Graph --}}
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ config('seo.site_name') }}">
<meta property="og:locale" content="{{ config('seo.locale') }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDesc }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:image" content="{{ $seoImg }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDesc }}">
<meta name="twitter:image" content="{{ $seoImg }}">

@if($organization)
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'TravelAgency',
    'name'     => $b['legal_name'],
    'url'      => $seoBase,
    'image'    => $seoImg,
    'logo'     => $seoBase . '/' . ltrim(config('seo.default_image'), '/'),
    'email'    => $b['email'],
    'telephone' => $b['phone'],
    'priceRange' => $b['price_range'],
    'description' => config('seo.default_description'),
    'address' => array_filter([
        '@type'           => 'PostalAddress',
        'streetAddress'   => $b['street'],
        'addressLocality' => $b['city'],
        'addressRegion'   => $b['region'],
        'postalCode'      => $b['postal_code'],
        'addressCountry'  => $b['country'],
    ]),
    'geo' => [
        '@type'     => 'GeoCoordinates',
        'latitude'  => $b['latitude'],
        'longitude' => $b['longitude'],
    ],
    'openingHoursSpecification' => array_map(fn ($h) => [
        '@type'     => 'OpeningHoursSpecification',
        'dayOfWeek' => $h['days'],
        'opens'     => $h['opens'],
        'closes'    => $h['closes'],
    ], $b['opening_hours']),
    'areaServed' => $b['areas_served'],
    'sameAs'     => array_values($b['same_as']),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
