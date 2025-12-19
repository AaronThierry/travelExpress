<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Evaluation - {{ $evaluation->first_name }} {{ $evaluation->last_name }}</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 10px;
            line-height: 1.5;
            color: #1a1a2e;
            background: #ffffff;
        }

        /* ===== LUXURY HEADER ===== */
        .header {
            background: #0f4c3a;
            color: white;
            padding: 25px 35px;
            position: relative;
            overflow: hidden;
        }

        .header-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 100%;
            opacity: 0.1;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255,255,255,0.1) 10px,
                rgba(255,255,255,0.1) 20px
            );
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .brand-section {
            display: table;
            width: 100%;
        }

        .brand-left {
            display: table-cell;
            vertical-align: middle;
            width: 65%;
        }

        .brand-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 35%;
        }

        .logo-container {
            display: inline-block;
        }

        .logo-icon {
            display: inline-block;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #d4af37, #f4d03f);
            background-color: #d4af37;
            border-radius: 10px;
            text-align: center;
            line-height: 45px;
            font-size: 22px;
            font-weight: bold;
            color: #0f4c3a;
            vertical-align: middle;
            margin-right: 12px;
        }

        .logo-text-container {
            display: inline-block;
            vertical-align: middle;
        }

        .logo-main {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #ffffff;
        }

        .logo-tagline {
            font-size: 8px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #d4af37;
            margin-top: 3px;
        }

        .doc-badge {
            display: inline-block;
            background: rgba(212, 175, 55, 0.2);
            border: 1px solid #d4af37;
            color: #d4af37;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .gold-bar {
            height: 4px;
            background: linear-gradient(90deg, #d4af37, #f4d03f, #d4af37);
            background-color: #d4af37;
        }

        /* ===== MAIN CONTENT ===== */
        .content {
            padding: 25px 35px 80px 35px;
        }

        /* ===== HERO PROFILE CARD ===== */
        .hero-card {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, #0f4c3a, #1a7f5a);
            background-color: #0f4c3a;
        }

        .hero-content {
            display: table;
            width: 100%;
        }

        .hero-avatar-section {
            display: table-cell;
            width: 80px;
            vertical-align: top;
        }

        .avatar {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #0f4c3a, #1a7f5a);
            background-color: #0f4c3a;
            border-radius: 50%;
            text-align: center;
            line-height: 65px;
            color: white;
            font-size: 24px;
            font-weight: bold;
            border: 3px solid #d4af37;
        }

        .hero-info-section {
            display: table-cell;
            vertical-align: top;
            padding-left: 15px;
        }

        .hero-name {
            font-size: 20px;
            font-weight: bold;
            color: #0f4c3a;
            margin-bottom: 3px;
            letter-spacing: 0.5px;
        }

        .hero-contact {
            font-size: 10px;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .hero-rating-section {
            display: table-cell;
            width: 140px;
            vertical-align: top;
            text-align: right;
        }

        .rating-display {
            background: linear-gradient(135deg, #fff8e1, #fffde7);
            background-color: #fff8e1;
            border: 1px solid #ffe082;
            border-radius: 12px;
            padding: 12px 15px;
            text-align: center;
        }

        .stars {
            font-size: 16px;
            color: #d4af37;
            letter-spacing: 3px;
            margin-bottom: 4px;
        }

        .rating-label {
            font-size: 9px;
            color: #8d6e00;
            font-weight: 600;
        }

        /* ===== STATUS BADGES ===== */
        .status-row {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px dashed #dee2e6;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-right: 8px;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-gold {
            background: linear-gradient(135deg, #fff8e1, #ffe082);
            background-color: #fff8e1;
            color: #8d6e00;
            border: 1px solid #d4af37;
        }

        .badge-info {
            background: #cce5ff;
            color: #004085;
            border: 1px solid #b8daff;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* ===== METRICS GRID ===== */
        .metrics-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-spacing: 8px;
        }

        .metric-card {
            display: table-cell;
            width: 25%;
            vertical-align: top;
        }

        .metric-inner {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 14px 10px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .metric-inner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #0f4c3a;
        }

        .metric-icon {
            font-size: 18px;
            margin-bottom: 6px;
        }

        .metric-label {
            font-size: 7px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .metric-value {
            font-size: 10px;
            font-weight: bold;
            color: #1a1a2e;
            line-height: 1.3;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 18px;
        }

        .section-header {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .section-icon {
            display: table-cell;
            width: 28px;
            vertical-align: middle;
        }

        .section-icon-circle {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #0f4c3a, #1a7f5a);
            background-color: #0f4c3a;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            color: white;
            font-size: 11px;
        }

        .section-title-container {
            display: table-cell;
            vertical-align: middle;
            padding-left: 10px;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #0f4c3a;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .section-subtitle {
            font-size: 8px;
            color: #6c757d;
            margin-top: 2px;
        }

        .section-content {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 14px 16px;
            border-left: 4px solid #0f4c3a;
            margin-left: 12px;
        }

        .section-text {
            font-size: 10px;
            color: #343a40;
            line-height: 1.7;
            text-align: justify;
        }

        /* ===== RATINGS DETAIL ===== */
        .ratings-container {
            background: linear-gradient(135deg, #fffbf0, #fff8e1);
            background-color: #fffbf0;
            border: 1px solid #ffe082;
            border-radius: 12px;
            padding: 15px;
            margin-left: 12px;
        }

        .ratings-row {
            display: table;
            width: 100%;
        }

        .rating-cell {
            display: table-cell;
            width: 20%;
            padding: 5px;
            text-align: center;
            vertical-align: top;
        }

        .rating-box {
            background: white;
            border-radius: 10px;
            padding: 10px 5px;
            border: 1px solid #f0e6d2;
        }

        .rating-box-label {
            font-size: 7px;
            color: #8d6e00;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .rating-box-score {
            font-size: 20px;
            font-weight: bold;
            color: #d4af37;
        }

        .rating-box-max {
            font-size: 10px;
            color: #adb5bd;
        }

        .rating-box-stars {
            font-size: 8px;
            color: #d4af37;
            margin-top: 3px;
            letter-spacing: 1px;
        }

        /* ===== TESTIMONIAL BOX ===== */
        .testimonial-container {
            background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
            background-color: #e8f5e9;
            border: 1px solid #a5d6a7;
            border-radius: 12px;
            padding: 18px 20px;
            margin-left: 12px;
            position: relative;
        }

        .quote-decoration {
            position: absolute;
            top: 8px;
            left: 12px;
            font-size: 45px;
            color: #0f4c3a;
            opacity: 0.15;
            font-family: Georgia, serif;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 11px;
            color: #2e7d32;
            line-height: 1.8;
            font-style: italic;
            padding-left: 20px;
            position: relative;
            z-index: 2;
        }

        /* ===== SIGNATURE SECTION ===== */
        .signature-container {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed #dee2e6;
        }

        .signature-box {
            display: inline-block;
            background: linear-gradient(135deg, #fffbf0, #fff8e1);
            background-color: #fffbf0;
            border: 2px dashed #d4af37;
            border-radius: 15px;
            padding: 15px 30px;
            min-width: 220px;
        }

        .signature-title {
            font-size: 8px;
            color: #8d6e00;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .signature-image {
            max-height: 60px;
            max-width: 180px;
        }

        .signature-date {
            font-size: 8px;
            color: #adb5bd;
            margin-top: 8px;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #0f4c3a;
            color: white;
            padding: 12px 35px;
        }

        .footer-content {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            width: 50%;
            vertical-align: middle;
        }

        .footer-right {
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: middle;
        }

        .footer-brand {
            font-size: 10px;
            font-weight: bold;
            color: #d4af37;
        }

        .footer-info {
            font-size: 8px;
            color: rgba(255,255,255,0.7);
            margin-top: 2px;
        }

        .footer-doc {
            font-size: 8px;
            color: rgba(255,255,255,0.7);
        }

        .footer-id {
            font-size: 9px;
            color: #d4af37;
            font-weight: bold;
        }

        /* ===== DECORATIVE ===== */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
            margin: 15px 0;
        }

        .watermark {
            position: fixed;
            bottom: 80px;
            right: 30px;
            font-size: 60px;
            color: rgba(15, 76, 58, 0.03);
            font-weight: bold;
            transform: rotate(-15deg);
            z-index: 0;
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">TRAVEL EXPRESS</div>

    <!-- Header -->
    <div class="header">
        <div class="header-pattern"></div>
        <div class="header-content">
            <div class="brand-section">
                <div class="brand-left">
                    <div class="logo-container">
                        <span class="logo-icon">TE</span>
                        <div class="logo-text-container">
                            <div class="logo-main">Travel Express</div>
                            <div class="logo-tagline">Excellence in International Education</div>
                        </div>
                    </div>
                </div>
                <div class="brand-right">
                    <span class="doc-badge">Fiche d'Evaluation</span>
                </div>
            </div>
        </div>
    </div>
    <div class="gold-bar"></div>

    <!-- Content -->
    <div class="content">
        <!-- Hero Profile Card -->
        <div class="hero-card">
            <div class="hero-content">
                <div class="hero-avatar-section">
                    <div class="avatar">{{ strtoupper(substr($evaluation->first_name, 0, 1)) }}{{ strtoupper(substr($evaluation->last_name, 0, 1)) }}</div>
                </div>
                <div class="hero-info-section">
                    <div class="hero-name">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</div>
                    <div class="hero-contact">{{ $evaluation->email }}</div>
                    @if($evaluation->phone)
                    <div class="hero-contact">{{ $evaluation->phone }}</div>
                    @endif
                </div>
                <div class="hero-rating-section">
                    <div class="rating-display">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $evaluation->rating ? "\u2605" : "\u2606" }}
                            @endfor
                        </div>
                        <div class="rating-label">Note Globale: {{ $evaluation->rating }}/5</div>
                    </div>
                </div>
            </div>

            <div class="status-row">
                @if($evaluation->would_recommend)
                    <span class="status-badge badge-info">Recommande Travel Express</span>
                @else
                    <span class="status-badge badge-danger">Ne recommande pas</span>
                @endif
                @if($evaluation->start_year)
                    <span class="status-badge badge-success">Promotion {{ $evaluation->start_year }}</span>
                @endif
                <span class="status-badge badge-gold">Service: {{ $evaluation->service_used ?? 'Etudes' }}</span>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-inner">
                    <div class="metric-label">Universite</div>
                    <div class="metric-value">{{ $evaluation->university }}</div>
                </div>
            </div>
            <div class="metric-card">
                <div class="metric-inner">
                    <div class="metric-label">Pays d'etude</div>
                    <div class="metric-value">{{ $evaluation->country_of_study }}</div>
                </div>
            </div>
            <div class="metric-card">
                <div class="metric-inner">
                    <div class="metric-label">Niveau d'etude</div>
                    <div class="metric-value">{{ $evaluation->study_level_label }}</div>
                </div>
            </div>
            <div class="metric-card">
                <div class="metric-inner">
                    <div class="metric-label">Filiere</div>
                    <div class="metric-value">{{ $evaluation->field_of_study }}</div>
                </div>
            </div>
        </div>

        <!-- Project Story -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon">
                    <div class="section-icon-circle">1</div>
                </div>
                <div class="section-title-container">
                    <div class="section-title">Parcours & Histoire</div>
                    <div class="section-subtitle">Comment le projet a ete realise</div>
                </div>
            </div>
            <div class="section-content">
                <p class="section-text">{{ $evaluation->project_story }}</p>
            </div>
        </div>

        <!-- Discovery Source -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon">
                    <div class="section-icon-circle">2</div>
                </div>
                <div class="section-title-container">
                    <div class="section-title">Source de Decouverte</div>
                    <div class="section-subtitle">Comment nous avez-vous connu</div>
                </div>
            </div>
            <div class="section-content">
                <p class="section-text">
                    <strong>{{ $evaluation->discovery_source_label }}</strong>
                    @if($evaluation->discovery_source_detail)
                        - {{ $evaluation->discovery_source_detail }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Detailed Ratings -->
        @if($evaluation->rating_accompagnement || $evaluation->rating_communication || $evaluation->rating_delais || $evaluation->rating_rapport_qualite_prix)
        <div class="section">
            <div class="section-header">
                <div class="section-icon">
                    <div class="section-icon-circle">3</div>
                </div>
                <div class="section-title-container">
                    <div class="section-title">Evaluations Detaillees</div>
                    <div class="section-subtitle">Notes par critere</div>
                </div>
            </div>
            <div class="ratings-container">
                <div class="ratings-row">
                    <div class="rating-cell">
                        <div class="rating-box">
                            <div class="rating-box-label">Globale</div>
                            <div class="rating-box-score">{{ $evaluation->rating }}<span class="rating-box-max">/5</span></div>
                            <div class="rating-box-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating ? "\u2605" : "\u2606" }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @if($evaluation->rating_accompagnement)
                    <div class="rating-cell">
                        <div class="rating-box">
                            <div class="rating-box-label">Accompagnement</div>
                            <div class="rating-box-score">{{ $evaluation->rating_accompagnement }}<span class="rating-box-max">/5</span></div>
                            <div class="rating-box-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_accompagnement ? "\u2605" : "\u2606" }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_communication)
                    <div class="rating-cell">
                        <div class="rating-box">
                            <div class="rating-box-label">Communication</div>
                            <div class="rating-box-score">{{ $evaluation->rating_communication }}<span class="rating-box-max">/5</span></div>
                            <div class="rating-box-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_communication ? "\u2605" : "\u2606" }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_delais)
                    <div class="rating-cell">
                        <div class="rating-box">
                            <div class="rating-box-label">Delais</div>
                            <div class="rating-box-score">{{ $evaluation->rating_delais }}<span class="rating-box-max">/5</span></div>
                            <div class="rating-box-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_delais ? "\u2605" : "\u2606" }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_rapport_qualite_prix)
                    <div class="rating-cell">
                        <div class="rating-box">
                            <div class="rating-box-label">Qualite/Prix</div>
                            <div class="rating-box-score">{{ $evaluation->rating_rapport_qualite_prix }}<span class="rating-box-max">/5</span></div>
                            <div class="rating-box-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_rapport_qualite_prix ? "\u2605" : "\u2606" }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Comment -->
        @if($evaluation->comment)
        <div class="section">
            <div class="section-header">
                <div class="section-icon">
                    <div class="section-icon-circle">4</div>
                </div>
                <div class="section-title-container">
                    <div class="section-title">Commentaire</div>
                    <div class="section-subtitle">Remarques supplementaires</div>
                </div>
            </div>
            <div class="section-content">
                <p class="section-text">{{ $evaluation->comment }}</p>
            </div>
        </div>
        @endif

        <!-- Public Testimonial -->
        @if($evaluation->public_testimonial)
        <div class="section">
            <div class="section-header">
                <div class="section-icon">
                    <div class="section-icon-circle">5</div>
                </div>
                <div class="section-title-container">
                    <div class="section-title">Temoignage</div>
                    <div class="section-subtitle">Message public</div>
                </div>
            </div>
            <div class="testimonial-container">
                <span class="quote-decoration">"</span>
                <p class="testimonial-text">{{ $evaluation->public_testimonial }}</p>
            </div>
        </div>
        @endif

        <!-- Signature -->
        @if($signature)
        <div class="signature-container">
            <div class="signature-box">
                <div class="signature-title">Signature Authentique</div>
                <img src="{{ $signature }}" alt="Signature" class="signature-image">
                @if($evaluation->signed_at)
                <div class="signature-date">Signe le {{ $evaluation->signed_at->format('d/m/Y') }}</div>
                @endif
            </div>
        </div>
        @endif

        <div class="divider"></div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <div class="footer-brand">TRAVEL EXPRESS</div>
                <div class="footer-info">Document genere le {{ $generatedAt }}</div>
            </div>
            <div class="footer-right">
                <div class="footer-doc">Document officiel - Usage interne</div>
                <div class="footer-id">REF: TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
    </div>
</body>
</html>
