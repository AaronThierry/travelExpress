<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Évaluation - {{ $evaluation->first_name }} {{ $evaluation->last_name }}</title>
    <style>
        /* Import Google Fonts - Elegant typography */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&display=swap');

        @page {
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #1f2937;
            background: #ffffff;
            font-weight: 400;
        }

        /* Elegant headings */
        h1, h2, h3, .logo-text, .profile-name {
            font-family: 'Playfair Display', 'DejaVu Serif', Georgia, serif;
        }

        /* Elegant quotes and testimonials */
        .testimonial-text, .quote-mark {
            font-family: 'Cormorant Garamond', 'DejaVu Serif', Georgia, serif;
        }

        .page {
            padding: 0;
            min-height: 100%;
        }

        /* Header with gradient effect */
        .header {
            background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
            background-color: #059669;
            color: white;
            padding: 30px 40px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            background-color: #fbbf24;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
            width: 70%;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 30%;
        }

        .logo-text {
            font-family: 'Playfair Display', 'DejaVu Serif', Georgia, serif;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .logo-subtext {
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
            font-size: 10px;
            opacity: 0.9;
            margin-top: 6px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 300;
        }

        .doc-type {
            background: rgba(255,255,255,0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
        }

        /* Main content */
        .content {
            padding: 30px 40px;
        }

        /* Profile section */
        .profile-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }

        .profile-header {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .profile-avatar {
            display: table-cell;
            width: 60px;
            vertical-align: top;
        }

        .avatar-circle {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #059669, #0d9488);
            background-color: #059669;
            border-radius: 25px;
            text-align: center;
            line-height: 50px;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .profile-info {
            display: table-cell;
            vertical-align: top;
            padding-left: 15px;
        }

        .profile-name {
            font-family: 'Playfair Display', 'DejaVu Serif', Georgia, serif;
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .profile-email {
            font-size: 11px;
            color: #6b7280;
        }

        .profile-phone {
            font-size: 11px;
            color: #6b7280;
        }

        .rating-section {
            display: table-cell;
            vertical-align: top;
            text-align: right;
            width: 150px;
        }

        .rating-stars {
            color: #fbbf24;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .rating-text {
            font-size: 10px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* Info cards */
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .info-card {
            display: table-cell;
            width: 25%;
            padding: 0 8px;
            vertical-align: top;
        }

        .info-card:first-child {
            padding-left: 0;
        }

        .info-card:last-child {
            padding-right: 0;
        }

        .info-card-inner {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }

        .info-icon {
            font-size: 20px;
            margin-bottom: 6px;
        }

        .info-label {
            font-size: 9px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 11px;
            font-weight: 600;
            color: #374151;
        }

        /* Sections */
        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-family: 'Playfair Display', 'DejaVu Serif', Georgia, serif;
            font-size: 14px;
            font-weight: 600;
            color: #059669;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #d1fae5;
        }

        .section-content {
            background: #f9fafb;
            border-radius: 8px;
            padding: 15px;
            border-left: 3px solid #059669;
        }

        .section-content p {
            color: #374151;
            line-height: 1.7;
        }

        /* Ratings grid */
        .ratings-grid {
            display: table;
            width: 100%;
        }

        .rating-item {
            display: table-cell;
            width: 20%;
            padding: 8px;
            text-align: center;
        }

        .rating-item-inner {
            background: #fffbeb;
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #fde68a;
        }

        .rating-item-label {
            font-size: 9px;
            color: #92400e;
            margin-bottom: 5px;
        }

        .rating-item-value {
            font-size: 18px;
            font-weight: bold;
            color: #b45309;
        }

        .rating-item-stars {
            color: #fbbf24;
            font-size: 10px;
        }

        /* Status badges */
        .badges {
            margin-top: 15px;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 9px;
            font-weight: 600;
            margin-right: 8px;
            margin-bottom: 5px;
        }

        .badge-verified {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-featured {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-recommend {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-not-recommend {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Signature section */
        .signature-section {
            margin-top: 25px;
            text-align: center;
        }

        .signature-box {
            background: #fffbeb;
            border: 2px dashed #fbbf24;
            border-radius: 12px;
            padding: 20px;
            display: inline-block;
            min-width: 250px;
        }

        .signature-label {
            font-size: 10px;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .signature-image {
            max-height: 80px;
            max-width: 200px;
        }

        .signature-date {
            font-size: 9px;
            color: #9ca3af;
            margin-top: 10px;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
            padding: 15px 40px;
            font-size: 9px;
            color: #6b7280;
        }

        .footer-content {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            width: 50%;
        }

        .footer-right {
            display: table-cell;
            width: 50%;
            text-align: right;
        }

        /* Decorative elements */
        .decorative-line {
            height: 3px;
            background: linear-gradient(90deg, #059669, #0d9488, #fbbf24);
            background-color: #059669;
            margin: 20px 0;
            border-radius: 2px;
        }

        /* Testimonial quote */
        .testimonial-box {
            background: linear-gradient(135deg, #ecfdf5, #f0fdfa);
            background-color: #ecfdf5;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #a7f3d0;
            position: relative;
        }

        .quote-mark {
            font-size: 40px;
            color: #059669;
            opacity: 0.3;
            position: absolute;
            top: 5px;
            left: 15px;
            font-family: Georgia, serif;
        }

        .testimonial-text {
            font-family: 'Cormorant Garamond', 'DejaVu Serif', Georgia, serif;
            padding-left: 25px;
            font-style: italic;
            color: #065f46;
            line-height: 1.9;
            font-size: 13px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="header-left">
                    <div class="logo-text">TRAVEL EXPRESS</div>
                    <div class="logo-subtext">Votre partenaire pour les etudes a l'etranger</div>
                </div>
                <div class="header-right">
                    <div class="doc-type">Fiche d'Evaluation</div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($evaluation->first_name, 0, 1)) }}{{ strtoupper(substr($evaluation->last_name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</div>
                        <div class="profile-email">{{ $evaluation->email }}</div>
                        @if($evaluation->phone)
                        <div class="profile-phone">{{ $evaluation->phone }}</div>
                        @endif
                    </div>
                    <div class="rating-section">
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $evaluation->rating ? '★' : '☆' }}
                            @endfor
                        </div>
                        <div class="rating-text">Note globale: {{ $evaluation->rating }}/5</div>
                    </div>
                </div>

                <!-- Badges -->
                <div class="badges">
                    @if($evaluation->is_verified)
                        <span class="badge badge-verified">Verifie</span>
                    @else
                        <span class="badge badge-pending">En attente</span>
                    @endif
                    @if($evaluation->is_featured)
                        <span class="badge badge-featured">Mis en avant</span>
                    @endif
                    @if($evaluation->would_recommend)
                        <span class="badge badge-recommend">Recommande Travel Express</span>
                    @else
                        <span class="badge badge-not-recommend">Ne recommande pas</span>
                    @endif
                </div>
            </div>

            <!-- Info Cards -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-inner">
                        <div class="info-label">Universite</div>
                        <div class="info-value">{{ $evaluation->university }}</div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-inner">
                        <div class="info-label">Pays</div>
                        <div class="info-value">{{ $evaluation->country_of_study }}</div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-inner">
                        <div class="info-label">Niveau</div>
                        <div class="info-value">{{ $evaluation->study_level_label }}</div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-inner">
                        <div class="info-label">Filiere</div>
                        <div class="info-value">{{ $evaluation->field_of_study }}</div>
                    </div>
                </div>
            </div>

            <!-- Project Story -->
            <div class="section">
                <div class="section-title">Histoire du Projet</div>
                <div class="section-content">
                    <p>{{ $evaluation->project_story }}</p>
                </div>
            </div>

            <!-- Discovery Source -->
            <div class="section">
                <div class="section-title">Source de Decouverte</div>
                <div class="section-content">
                    <p>
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
                <div class="section-title">Evaluations Detaillees</div>
                <div class="ratings-grid">
                    <div class="rating-item">
                        <div class="rating-item-inner">
                            <div class="rating-item-label">Globale</div>
                            <div class="rating-item-value">{{ $evaluation->rating }}/5</div>
                            <div class="rating-item-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @if($evaluation->rating_accompagnement)
                    <div class="rating-item">
                        <div class="rating-item-inner">
                            <div class="rating-item-label">Accompagnement</div>
                            <div class="rating-item-value">{{ $evaluation->rating_accompagnement }}/5</div>
                            <div class="rating-item-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_accompagnement ? '★' : '☆' }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_communication)
                    <div class="rating-item">
                        <div class="rating-item-inner">
                            <div class="rating-item-label">Communication</div>
                            <div class="rating-item-value">{{ $evaluation->rating_communication }}/5</div>
                            <div class="rating-item-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_communication ? '★' : '☆' }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_delais)
                    <div class="rating-item">
                        <div class="rating-item-inner">
                            <div class="rating-item-label">Delais</div>
                            <div class="rating-item-value">{{ $evaluation->rating_delais }}/5</div>
                            <div class="rating-item-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_delais ? '★' : '☆' }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($evaluation->rating_rapport_qualite_prix)
                    <div class="rating-item">
                        <div class="rating-item-inner">
                            <div class="rating-item-label">Qualite/Prix</div>
                            <div class="rating-item-value">{{ $evaluation->rating_rapport_qualite_prix }}/5</div>
                            <div class="rating-item-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $evaluation->rating_rapport_qualite_prix ? '★' : '☆' }}
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Comment -->
            @if($evaluation->comment)
            <div class="section">
                <div class="section-title">Commentaire</div>
                <div class="section-content">
                    <p>{{ $evaluation->comment }}</p>
                </div>
            </div>
            @endif

            <!-- Public Testimonial -->
            @if($evaluation->public_testimonial)
            <div class="section">
                <div class="section-title">Temoignage Public</div>
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
                    <div class="signature-label">Signature</div>
                    <img src="{{ $signature }}" alt="Signature" class="signature-image">
                    @if($evaluation->signed_at)
                    <div class="signature-date">Signe le {{ $evaluation->signed_at->format('d/m/Y a H:i') }}</div>
                    @endif
                </div>
            </div>
            @endif

            <div class="decorative-line"></div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <strong>Travel Express</strong> - Document genere le {{ $generatedAt }}
                </div>
                <div class="footer-right">
                    Evaluation #{{ str_pad($evaluation->id, 4, '0', STR_PAD_LEFT) }} | Confidentiel
                </div>
            </div>
        </div>
    </div>
</body>
</html>
