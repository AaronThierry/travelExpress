<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre dossier visa — Travel Express</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=DM+Sans:wght@400;500&display=swap');

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background-color: #0a0a0a;
            font-family: 'DM Sans', Verdana, sans-serif;
            color: #f5f0e8;
            padding: 40px 20px;
        }

        .wrapper {
            max-width: 580px;
            margin: 0 auto;
        }

        /* ── Header brand ── */
        .brand-header {
            text-align: center;
            padding-bottom: 28px;
            border-bottom: 1px solid rgba(212,175,55,0.2);
            margin-bottom: 32px;
        }

        .brand-name {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 22px;
            font-weight: 700;
            color: #D4AF37;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .brand-tagline {
            font-size: 12px;
            color: rgba(245,240,232,0.45);
            letter-spacing: 0.12em;
            margin-top: 5px;
        }

        /* ── Main card ── */
        .card {
            background: #101010;
            border: 1px solid rgba(212,175,55,0.2);
            border-radius: 16px;
            padding: 40px 36px;
            position: relative;
            overflow: hidden;
        }

        /* Gold top line */
        .card::before {
            content: '';
            display: block;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #D4AF37 40%, #F0D060 60%, transparent 100%);
            margin: -40px -36px 36px;
        }

        /* ── Greeting ── */
        .greeting-label {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 10px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #D4AF37;
            margin-bottom: 8px;
        }

        .greeting-name {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 20px;
            font-weight: 700;
            color: #f5f0e8;
            margin-bottom: 20px;
        }

        .intro-text {
            font-size: 14.5px;
            line-height: 1.75;
            color: rgba(245,240,232,0.7);
            margin-bottom: 10px;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid rgba(212,175,55,0.12);
            margin: 28px 0;
        }

        /* ── Documents list ── */
        .docs-label {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 9px;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #D4AF37;
            margin-bottom: 14px;
        }

        .doc-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
        }

        .doc-bullet {
            width: 18px;
            height: 18px;
            border: 1px solid rgba(212,175,55,0.4);
            border-radius: 4px;
            flex-shrink: 0;
            margin-top: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .doc-bullet-inner {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(212,175,55,0.5);
        }

        .doc-name {
            font-size: 13.5px;
            color: rgba(245,240,232,0.72);
            line-height: 1.4;
        }

        .doc-badge {
            display: inline-block;
            font-size: 10px;
            padding: 1px 8px;
            border-radius: 100px;
            border: 1px solid rgba(156,163,175,0.3);
            color: #9ca3af;
            background: rgba(156,163,175,0.06);
            margin-left: 6px;
            vertical-align: middle;
        }

        /* ── CTA button ── */
        .cta-section {
            text-align: center;
            margin: 32px 0 28px;
        }

        .cta-label {
            font-size: 12px;
            color: rgba(245,240,232,0.4);
            margin-bottom: 14px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #B8960C 0%, #D4AF37 50%, #C9A227 100%);
            color: #080808 !important;
            text-decoration: none;
            padding: 15px 36px;
            border-radius: 10px;
            font-family: 'Cinzel', Georgia, serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        /* ── Fallback URL ── */
        .url-box {
            background: #181818;
            border: 1px solid rgba(212,175,55,0.14);
            border-radius: 8px;
            padding: 12px 15px;
            margin-top: 16px;
        }

        .url-label {
            font-size: 11px;
            color: rgba(245,240,232,0.35);
            margin-bottom: 5px;
        }

        .url-text {
            font-size: 11.5px;
            color: rgba(212,175,55,0.75);
            word-break: break-all;
            line-height: 1.5;
        }

        /* ── Expiry notice ── */
        .expiry-notice {
            background: rgba(212,175,55,0.06);
            border-left: 3px solid rgba(212,175,55,0.4);
            border-radius: 0 8px 8px 0;
            padding: 12px 16px;
            margin-top: 24px;
        }

        .expiry-notice p {
            font-size: 12.5px;
            color: rgba(245,240,232,0.55);
            line-height: 1.6;
        }

        .expiry-notice strong {
            color: #D4AF37;
            font-weight: 600;
        }

        /* ── Footer ── */
        .footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(212,175,55,0.12);
        }

        .footer p {
            font-size: 11.5px;
            color: rgba(245,240,232,0.3);
            line-height: 1.7;
        }

        .footer-ornament {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 10px;
            letter-spacing: 0.2em;
            color: rgba(212,175,55,0.35);
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
<div class="wrapper">

    {{-- ── Brand header ── --}}
    <div class="brand-header">
        <div class="brand-name">✦ Travel Express ✦</div>
        <div class="brand-tagline">Votre partenaire visa &amp; mobilité internationale</div>
    </div>

    {{-- ── Main card ── --}}
    <div class="card">

        <p class="greeting-label">Dossier Visa — Accès personnel</p>
        <p class="greeting-name">{{ $visa->student_name ?? 'Bonjour' }},</p>

        <p class="intro-text">
            Travel Express a créé votre dossier visa et vous invite à le compléter en ligne.
            Vous trouverez ci-dessous votre lien d'accès personnel et sécurisé pour soumettre vos documents.
        </p>
        <p class="intro-text">
            Ce lien est strictement personnel. Il vous permet d'accéder à votre espace de dépôt de documents
            sans avoir besoin de créer un compte.
        </p>

        <hr class="divider">

        {{-- ── Documents list ── --}}
        <p class="docs-label">Documents à fournir</p>

        @foreach(\App\Models\VisaApplication::DOCUMENTS as $type => $label)
            @php
                $isOptional = in_array($type, \App\Models\VisaApplication::OPTIONAL_DOCUMENTS);
                $cleanLabel = str_replace(' (optionnel)', '', $label);
            @endphp
            <div class="doc-item">
                <div class="doc-bullet"><div class="doc-bullet-inner"></div></div>
                <div class="doc-name">
                    {{ $cleanLabel }}
                    @if($isOptional)
                        <span class="doc-badge">Optionnel</span>
                    @endif
                </div>
            </div>
        @endforeach

        <p style="font-size:12px; color:rgba(245,240,232,0.35); margin-top:10px;">
            Formats acceptés : PDF, JPG, PNG, DOC · 10 Mo max par fichier
        </p>

        <hr class="divider">

        {{-- ── CTA ── --}}
        <div class="cta-section">
            <p class="cta-label">Cliquez sur le bouton pour accéder à votre dossier</p>
            <a href="{{ $accessUrl }}" class="cta-button">
                Accéder à mon dossier visa
            </a>

            <div class="url-box" style="margin-top:18px;">
                <p class="url-label">Ou copiez ce lien dans votre navigateur :</p>
                <p class="url-text">{{ $accessUrl }}</p>
            </div>
        </div>

        {{-- ── Expiry notice ── --}}
        <div class="expiry-notice">
            <p>
                <strong>Lien valide 60 jours</strong> — Ce lien expirera le
                <strong>{{ $expiresAt }}</strong>.
                Après cette date, contactez-nous pour obtenir un nouveau lien.
            </p>
        </div>

    </div>

    {{-- ── Footer ── --}}
    <div class="footer">
        <div class="footer-ornament">✦ ✦ ✦</div>
        <p>&copy; {{ date('Y') }} Travel Express. Tous droits réservés.</p>
        <p>Cet e-mail a été envoyé automatiquement — merci de ne pas y répondre directement.</p>
    </div>

</div>
</body>
</html>
