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
            color: #2d3748;
            background: #ffffff;
        }

        /* ===== ELEGANT HEADER ===== */
        .header {
            background: #1a5d4a;
            color: white;
            padding: 30px 40px;
            position: relative;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 40%;
        }

        .logo-box {
            display: inline-block;
            background: #c9a227;
            width: 50px;
            height: 50px;
            border-radius: 8px;
            text-align: center;
            line-height: 50px;
            font-size: 20px;
            font-weight: bold;
            color: #1a5d4a;
            vertical-align: middle;
            margin-right: 15px;
        }

        .logo-text {
            display: inline-block;
            vertical-align: middle;
        }

        .logo-main {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .logo-sub {
            font-size: 9px;
            color: #c9a227;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        .doc-title {
            background: rgba(201, 162, 39, 0.2);
            border: 2px solid #c9a227;
            color: #c9a227;
            padding: 10px 25px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            display: inline-block;
        }

        .gold-line {
            height: 5px;
            background: #c9a227;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 30px 40px 90px 40px;
        }

        /* ===== PROFILE CARD ===== */
        .profile-card {
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            position: relative;
        }

        .profile-card-accent {
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: #1a5d4a;
            border-radius: 15px 0 0 15px;
        }

        .profile-row {
            display: table;
            width: 100%;
        }

        .profile-avatar-cell {
            display: table-cell;
            width: 85px;
            vertical-align: top;
        }

        .avatar {
            width: 70px;
            height: 70px;
            background: #1a5d4a;
            border-radius: 50%;
            text-align: center;
            line-height: 70px;
            color: white;
            font-size: 26px;
            font-weight: bold;
            border: 4px solid #c9a227;
        }

        .profile-info-cell {
            display: table-cell;
            vertical-align: top;
            padding-left: 20px;
        }

        .profile-name {
            font-size: 22px;
            font-weight: bold;
            color: #1a5d4a;
            margin-bottom: 5px;
        }

        .profile-email {
            font-size: 11px;
            color: #718096;
            margin-bottom: 3px;
        }

        .profile-rating-cell {
            display: table-cell;
            width: 160px;
            vertical-align: top;
            text-align: right;
        }

        .rating-box {
            background: #fffbeb;
            border: 2px solid #c9a227;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
        }

        .rating-score {
            font-size: 36px;
            font-weight: bold;
            color: #c9a227;
        }

        .rating-max {
            font-size: 16px;
            color: #a0aec0;
        }

        .rating-text {
            font-size: 10px;
            color: #92400e;
            margin-top: 5px;
            font-weight: 600;
        }

        .rating-dots {
            margin-top: 8px;
        }

        .dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 2px;
        }

        .dot-filled {
            background: #c9a227;
        }

        .dot-empty {
            background: #e2e8f0;
            border: 1px solid #cbd5e0;
        }

        /* ===== TAGS ===== */
        .tags-row {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #e2e8f0;
        }

        .tag {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: bold;
            margin-right: 10px;
            letter-spacing: 0.5px;
        }

        .tag-green {
            background: #c6f6d5;
            color: #22543d;
        }

        .tag-blue {
            background: #bee3f8;
            color: #2a4365;
        }

        .tag-gold {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #c9a227;
        }

        .tag-red {
            background: #fed7d7;
            color: #742a2a;
        }

        /* ===== INFO GRID ===== */
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-spacing: 10px;
        }

        .info-item {
            display: table-cell;
            width: 25%;
            vertical-align: top;
        }

        .info-box {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            height: 100%;
        }

        .info-box-top {
            height: 4px;
            background: #1a5d4a;
            border-radius: 10px 10px 0 0;
            margin: -15px -15px 12px -15px;
        }

        .info-label {
            font-size: 8px;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 11px;
            font-weight: bold;
            color: #2d3748;
            line-height: 1.4;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 22px;
        }

        .section-header {
            display: table;
            width: 100%;
            margin-bottom: 12px;
        }

        .section-num {
            display: table-cell;
            width: 35px;
            vertical-align: middle;
        }

        .num-circle {
            width: 28px;
            height: 28px;
            background: #1a5d4a;
            border-radius: 50%;
            text-align: center;
            line-height: 28px;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .section-title-box {
            display: table-cell;
            vertical-align: middle;
            padding-left: 12px;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #1a5d4a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-subtitle {
            font-size: 9px;
            color: #a0aec0;
            margin-top: 2px;
        }

        .section-body {
            background: #f7fafc;
            border-radius: 10px;
            padding: 16px 18px;
            border-left: 5px solid #1a5d4a;
            margin-left: 14px;
        }

        .section-text {
            font-size: 11px;
            color: #4a5568;
            line-height: 1.8;
        }

        /* ===== RATINGS GRID ===== */
        .ratings-box {
            background: #fffbeb;
            border: 2px solid #c9a227;
            border-radius: 12px;
            padding: 18px;
            margin-left: 14px;
        }

        .ratings-grid {
            display: table;
            width: 100%;
        }

        .rating-item {
            display: table-cell;
            width: 20%;
            padding: 6px;
            text-align: center;
            vertical-align: top;
        }

        .rating-item-box {
            background: white;
            border-radius: 10px;
            padding: 12px 8px;
            border: 1px solid #fde68a;
        }

        .rating-item-label {
            font-size: 8px;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .rating-item-score {
            font-size: 28px;
            font-weight: bold;
            color: #c9a227;
        }

        .rating-item-max {
            font-size: 12px;
            color: #a0aec0;
        }

        .rating-item-dots {
            margin-top: 6px;
        }

        .mini-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin: 0 1px;
        }

        /* ===== TESTIMONIAL ===== */
        .testimonial-box {
            background: #f0fff4;
            border: 2px solid #9ae6b4;
            border-radius: 12px;
            padding: 20px;
            margin-left: 14px;
            position: relative;
        }

        .quote-mark {
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 50px;
            color: #1a5d4a;
            opacity: 0.2;
            font-family: Georgia, serif;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 12px;
            color: #276749;
            line-height: 1.9;
            font-style: italic;
            padding-left: 25px;
        }

        /* ===== SIGNATURE ===== */
        .signature-section {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px dashed #e2e8f0;
        }

        .signature-box {
            display: inline-block;
            background: #fffbeb;
            border: 3px dashed #c9a227;
            border-radius: 15px;
            padding: 20px 40px;
            min-width: 250px;
        }

        .signature-label {
            font-size: 9px;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 12px;
            font-weight: bold;
        }

        .signature-img {
            max-height: 70px;
            max-width: 200px;
        }

        .signature-date {
            font-size: 9px;
            color: #a0aec0;
            margin-top: 10px;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #1a5d4a;
            color: white;
            padding: 15px 40px;
        }

        .footer-row {
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
            font-size: 12px;
            font-weight: bold;
            color: #c9a227;
        }

        .footer-date {
            font-size: 9px;
            color: rgba(255,255,255,0.7);
            margin-top: 3px;
        }

        .footer-ref {
            font-size: 11px;
            color: #c9a227;
            font-weight: bold;
        }

        .footer-type {
            font-size: 8px;
            color: rgba(255,255,255,0.6);
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <span class="logo-box">TE</span>
                <div class="logo-text">
                    <div class="logo-main">TRAVEL EXPRESS</div>
                    <div class="logo-sub">EXCELLENCE IN INTERNATIONAL EDUCATION</div>
                </div>
            </div>
            <div class="header-right">
                <span class="doc-title">FICHE D'EVALUATION</span>
            </div>
        </div>
    </div>
    <div class="gold-line"></div>

    <!-- Content -->
    <div class="content">
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-card-accent"></div>
            <div class="profile-row">
                <div class="profile-avatar-cell">
                    <div class="avatar">{{ strtoupper(substr($evaluation->first_name, 0, 1)) }}{{ strtoupper(substr($evaluation->last_name, 0, 1)) }}</div>
                </div>
                <div class="profile-info-cell">
                    <div class="profile-name">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</div>
                    <div class="profile-email">{{ $evaluation->email }}</div>
                    @if($evaluation->phone)
                    <div class="profile-email">{{ $evaluation->phone }}</div>
                    @endif
                </div>
                <div class="profile-rating-cell">
                    <div class="rating-box">
                        <div class="rating-score">{{ $evaluation->rating }}<span class="rating-max">/5</span></div>
                        <div class="rating-dots">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="dot {{ $i <= $evaluation->rating ? 'dot-filled' : 'dot-empty' }}"></span>
                            @endfor
                        </div>
                        <div class="rating-text">NOTE GLOBALE</div>
                    </div>
                </div>
            </div>

            <div class="tags-row">
                @if($evaluation->would_recommend)
                    <span class="tag tag-blue">RECOMMANDE TRAVEL EXPRESS</span>
                @else
                    <span class="tag tag-red">NE RECOMMANDE PAS</span>
                @endif
                @if($evaluation->start_year)
                    <span class="tag tag-green">PROMOTION {{ $evaluation->start_year }}</span>
                @endif
                <span class="tag tag-gold">SERVICE: {{ strtoupper($evaluation->service_used ?? 'ETUDES') }}</span>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-box">
                    <div class="info-box-top"></div>
                    <div class="info-label">Universite</div>
                    <div class="info-value">{{ $evaluation->university }}</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-box">
                    <div class="info-box-top"></div>
                    <div class="info-label">Pays d'etude</div>
                    <div class="info-value">{{ $evaluation->country_of_study }}</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-box">
                    <div class="info-box-top"></div>
                    <div class="info-label">Niveau</div>
                    <div class="info-value">{{ $evaluation->study_level_label }}</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-box">
                    <div class="info-box-top"></div>
                    <div class="info-label">Filiere</div>
                    <div class="info-value">{{ $evaluation->field_of_study }}</div>
                </div>
            </div>
        </div>

        <!-- Section 1: Parcours -->
        <div class="section">
            <div class="section-header">
                <div class="section-num">
                    <div class="num-circle">1</div>
                </div>
                <div class="section-title-box">
                    <div class="section-title">Parcours & Histoire</div>
                    <div class="section-subtitle">Comment le projet a ete realise</div>
                </div>
            </div>
            <div class="section-body">
                <p class="section-text">{{ $evaluation->project_story }}</p>
            </div>
        </div>

        <!-- Section 2: Source -->
        <div class="section">
            <div class="section-header">
                <div class="section-num">
                    <div class="num-circle">2</div>
                </div>
                <div class="section-title-box">
                    <div class="section-title">Source de Decouverte</div>
                    <div class="section-subtitle">Comment nous avez-vous connu</div>
                </div>
            </div>
            <div class="section-body">
                <p class="section-text">
                    <strong>{{ $evaluation->discovery_source_label }}</strong>
                    @if($evaluation->discovery_source_detail)
                        - {{ $evaluation->discovery_source_detail }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Section 3: Ratings -->
        @if($evaluation->rating_accompagnement || $evaluation->rating_communication || $evaluation->rating_delais || $evaluation->rating_rapport_qualite_prix)
        <div class="section">
            <div class="section-header">
                <div class="section-num">
                    <div class="num-circle">3</div>
                </div>
                <div class="section-title-box">
                    <div class="section-title">Evaluations Detaillees</div>
                    <div class="section-subtitle">Notes par critere</div>
                </div>
            </div>
            <div class="ratings-box">
                <div class="ratings-grid">
                    <div class="rating-item">
                        <div class="rating-item-box">
                            <div class="rating-item-label">Globale</div>
                            <div class="rating-item-score">{{ $evaluation->rating }}<span class="rating-item-max">/5</span></div>
                            <div class="rating-item-dots">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="mini-dot {{ $i <= $evaluation->rating ? 'dot-filled' : 'dot-empty' }}"></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @if($evaluation->rating_accompagnement)
                    <div class="rating-item">
                        <div class="rating-item-box">
                            <div class="rating-item-label">Accompagnement</div>
                            <div class="rating-item-score">{{ $evaluation->rating_accompagnement }}<span class="rating-item-max">/5</span></div>
                            <div class="rating-item-dots">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="mini-dot {{ $i <= $evaluation->rating_accompagnement ? 'dot-filled' : 'dot-empty' }}"></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_communication)
                    <div class="rating-item">
                        <div class="rating-item-box">
                            <div class="rating-item-label">Communication</div>
                            <div class="rating-item-score">{{ $evaluation->rating_communication }}<span class="rating-item-max">/5</span></div>
                            <div class="rating-item-dots">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="mini-dot {{ $i <= $evaluation->rating_communication ? 'dot-filled' : 'dot-empty' }}"></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_delais)
                    <div class="rating-item">
                        <div class="rating-item-box">
                            <div class="rating-item-label">Delais</div>
                            <div class="rating-item-score">{{ $evaluation->rating_delais }}<span class="rating-item-max">/5</span></div>
                            <div class="rating-item-dots">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="mini-dot {{ $i <= $evaluation->rating_delais ? 'dot-filled' : 'dot-empty' }}"></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_rapport_qualite_prix)
                    <div class="rating-item">
                        <div class="rating-item-box">
                            <div class="rating-item-label">Qualite/Prix</div>
                            <div class="rating-item-score">{{ $evaluation->rating_rapport_qualite_prix }}<span class="rating-item-max">/5</span></div>
                            <div class="rating-item-dots">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="mini-dot {{ $i <= $evaluation->rating_rapport_qualite_prix ? 'dot-filled' : 'dot-empty' }}"></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Section 4: Comment -->
        @if($evaluation->comment)
        <div class="section">
            <div class="section-header">
                <div class="section-num">
                    <div class="num-circle">4</div>
                </div>
                <div class="section-title-box">
                    <div class="section-title">Commentaire</div>
                    <div class="section-subtitle">Remarques supplementaires</div>
                </div>
            </div>
            <div class="section-body">
                <p class="section-text">{{ $evaluation->comment }}</p>
            </div>
        </div>
        @endif

        <!-- Section 5: Testimonial -->
        @if($evaluation->public_testimonial)
        <div class="section">
            <div class="section-header">
                <div class="section-num">
                    <div class="num-circle">5</div>
                </div>
                <div class="section-title-box">
                    <div class="section-title">Temoignage</div>
                    <div class="section-subtitle">Message public</div>
                </div>
            </div>
            <div class="testimonial-box">
                <span class="quote-mark">"</span>
                <p class="testimonial-text">{{ $evaluation->public_testimonial }}</p>
            </div>
        </div>
        @endif

        <!-- Signature -->
        @if($signature)
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-label">Signature Authentique</div>
                <img src="{{ $signature }}" alt="Signature" class="signature-img">
                @if($evaluation->signed_at)
                <div class="signature-date">Signe le {{ $evaluation->signed_at->format('d/m/Y') }}</div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-row">
            <div class="footer-left">
                <div class="footer-brand">TRAVEL EXPRESS</div>
                <div class="footer-date">Document genere le {{ $generatedAt }}</div>
            </div>
            <div class="footer-right">
                <div class="footer-ref">REF: TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="footer-type">Document officiel - Usage interne</div>
            </div>
        </div>
    </div>
</body>
</html>
