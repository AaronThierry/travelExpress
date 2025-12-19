<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attestation - {{ $evaluation->first_name }} {{ $evaluation->last_name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap');

        @page {
            margin: 0;
            size: A4 portrait;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.4;
            color: #1a1a1a;
            background: #ffffff;
        }

        /* ===== HEADER NOIR & OR ===== */
        .header {
            background: #0a0a0a;
            color: white;
            padding: 22px 40px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #d4af37;
        }

        .header-table {
            width: 100%;
        }

        .header-left {
            vertical-align: middle;
        }

        .header-right {
            text-align: right;
            vertical-align: middle;
        }

        .logo-box {
            display: inline-block;
            background: #d4af37;
            width: 42px;
            height: 42px;
            border-radius: 6px;
            text-align: center;
            line-height: 42px;
            font-size: 16pt;
            font-weight: 800;
            color: #0a0a0a;
            vertical-align: middle;
            margin-right: 14px;
            font-family: 'Poppins', sans-serif;
        }

        .logo-text {
            display: inline-block;
            vertical-align: middle;
        }

        .company-name {
            font-size: 18pt;
            font-weight: 700;
            letter-spacing: 3px;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            color: #ffffff;
        }

        .company-tagline {
            font-size: 6.5pt;
            color: #d4af37;
            letter-spacing: 2px;
            margin-top: 3px;
            text-transform: uppercase;
            font-weight: 500;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
        }

        .doc-badge {
            display: inline-block;
            background: #d4af37;
            color: #0a0a0a;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 7pt;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Poppins', sans-serif;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 25px 40px 20px 40px;
        }

        /* ===== TITLE ===== */
        .title-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .title-main {
            font-size: 20pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 6px;
            color: #0a0a0a;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            margin-bottom: 6px;
        }

        .title-sub {
            font-size: 8pt;
            color: #666666;
            font-weight: 400;
            font-style: italic;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
        }

        .doc-ref {
            font-size: 8pt;
            color: #0a0a0a;
            margin-top: 8px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 16px;
        }

        .section-header {
            background: #0a0a0a;
            color: #d4af37;
            padding: 8px 15px;
            border-radius: 4px;
            margin-bottom: 10px;
            display: table;
            width: 100%;
        }

        .section-icon {
            display: table-cell;
            width: 22px;
            vertical-align: middle;
            font-size: 11pt;
        }

        .section-title {
            display: table-cell;
            vertical-align: middle;
            font-size: 10pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        /* ===== INFO TABLE ===== */
        .info-table-wrapper {
            width: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
        }

        .info-row {
            display: table;
            width: 100%;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            display: table-cell;
            width: 28%;
            padding: 10px 14px;
            background: #fafafa;
            font-weight: 700;
            color: #0a0a0a;
            font-size: 8.5pt;
            border-right: 1px solid #f0f0f0;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        .info-value {
            display: table-cell;
            width: 22%;
            padding: 10px 14px;
            color: #333333;
            font-size: 9pt;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
            font-weight: 500;
        }

        /* ===== RATING SECTION ===== */
        .rating-wrapper {
            display: table;
            width: 100%;
        }

        .rating-score-box {
            display: table-cell;
            width: 18%;
            vertical-align: middle;
            text-align: center;
        }

        .rating-big {
            font-size: 52pt;
            font-weight: 800;
            color: #d4af37;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            line-height: 1;
        }

        .rating-info-box {
            display: table-cell;
            width: 82%;
            vertical-align: middle;
            padding-left: 25px;
        }

        .rating-line {
            background: #fafafa;
            border: 1px solid #e8e8e8;
            border-left: 4px solid #d4af37;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 0 6px 6px 0;
            font-size: 9pt;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
        }

        .rating-line:last-child {
            margin-bottom: 0;
        }

        .rating-line strong {
            color: #0a0a0a;
            font-weight: 700;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            font-size: 7pt;
            font-weight: 700;
            border-radius: 12px;
            margin-left: 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        .badge-success {
            background: #d4af37;
            color: #0a0a0a;
        }

        .badge-danger {
            background: #0a0a0a;
            color: #ffffff;
        }

        /* ===== RATINGS DETAIL TABLE ===== */
        .ratings-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #0a0a0a;
            border-radius: 6px;
            overflow: hidden;
        }

        .ratings-table th {
            background: #0a0a0a;
            color: #d4af37;
            padding: 10px 8px;
            font-size: 7.5pt;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Poppins', sans-serif;
        }

        .ratings-table td {
            padding: 14px 8px;
            text-align: center;
            background: #fafafa;
            border: 1px solid #e8e8e8;
        }

        .ratings-table .score {
            font-size: 16pt;
            font-weight: 800;
            color: #d4af37;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        /* ===== TEXT BOX ===== */
        .text-label {
            font-size: 7pt;
            color: #888888;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        .text-box {
            background: #fafafa;
            border: 1px solid #e0e0e0;
            border-left: 4px solid #0a0a0a;
            padding: 12px 16px;
            font-size: 9pt;
            line-height: 1.6;
            border-radius: 0 6px 6px 0;
            color: #333333;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
            font-weight: 400;
        }

        /* ===== SIGNATURE SECTION ===== */
        .auth-wrapper {
            border: 2px solid #0a0a0a;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }

        .auth-header {
            background: #0a0a0a;
            color: #d4af37;
            padding: 8px 15px;
            text-align: center;
        }

        .auth-header-text {
            font-size: 8pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        .signature-grid {
            width: 100%;
        }

        .signature-grid td {
            width: 50%;
            vertical-align: top;
            padding: 15px 20px;
            border-right: 1px solid #e0e0e0;
        }

        .signature-grid td:last-child {
            border-right: none;
        }

        .signature-box {
            text-align: center;
            min-height: 120px;
            background: #ffffff;
        }

        .signature-title {
            font-size: 7pt;
            color: #0a0a0a;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            font-weight: 700;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            background: #f5f5f5;
            padding: 6px 10px;
            border-radius: 4px;
        }

        .signature-area {
            min-height: 70px;
            display: block;
            margin: 10px 0;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 8px;
        }

        .signature-img {
            max-height: 100px;
            max-width: 250px;
            margin: 0 auto;
            display: block;
        }

        .signature-name {
            font-size: 11pt;
            font-weight: 700;
            color: #0a0a0a;
            margin-top: 8px;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        .signature-date {
            font-size: 8pt;
            color: #666666;
            margin-top: 3px;
            font-weight: 500;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
        }

        .stamp-container {
            min-height: 70px;
            display: block;
            margin: 10px 0;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 8px;
        }

        .stamp-text {
            font-size: 13pt;
            font-weight: 800;
            color: #0a0a0a;
            margin: 10px 0 5px 0;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            letter-spacing: 2px;
        }

        .stamp-subtitle {
            font-size: 9pt;
            font-weight: 600;
            color: #666666;
            font-family: 'Poppins', sans-serif;
        }

        /* ===== LEGAL ===== */
        .legal {
            margin-top: 15px;
            padding: 12px 16px;
            background: #fafafa;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 7pt;
            color: #666666;
            line-height: 1.5;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
        }

        .legal strong {
            color: #0a0a0a;
            font-weight: 700;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #0a0a0a;
            color: white;
            padding: 12px 40px;
        }

        .footer-table {
            width: 100%;
        }

        .footer-left {
            font-size: 7pt;
            color: #888888;
            font-weight: 400;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
        }

        .footer-center {
            text-align: center;
            font-size: 9pt;
            color: #d4af37;
            font-weight: 700;
            letter-spacing: 2px;
            font-family: 'Poppins', sans-serif;
        }

        .footer-right {
            text-align: right;
            font-size: 7pt;
            color: #888888;
            font-weight: 400;
            font-family: 'Montserrat', 'DejaVu Sans', sans-serif;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <span class="logo-box">TE</span>
                    <div class="logo-text">
                        <div class="company-name">TRAVEL EXPRESS</div>
                        <div class="company-tagline">Excellence in International Education</div>
                    </div>
                </td>
                <td class="header-right">
                    <span class="doc-badge">Attestation Officielle</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <!-- TITLE -->
        <div class="title-section">
            <div class="title-main">Fiche d'Evaluation</div>
            <div class="title-sub">Document officiel de satisfaction client</div>
            <div class="doc-ref">REF: TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }} | {{ $generatedAt }}</div>
        </div>

        <!-- SECTION 1: INFOS -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon">&#10102;</div>
                <div class="section-title">Informations</div>
            </div>
            <div class="info-table-wrapper">
                <div class="info-row">
                    <div class="info-label">Nom complet</div>
                    <div class="info-value">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</div>
                    <div class="info-label">Universite</div>
                    <div class="info-value">{{ $evaluation->university }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $evaluation->email }}</div>
                    <div class="info-label">Pays / Niveau</div>
                    <div class="info-value">{{ $evaluation->country_of_study }} - {{ $evaluation->study_level_label }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Service</div>
                    <div class="info-value">{{ ucfirst($evaluation->service_used ?? 'Etudes') }}</div>
                    <div class="info-label">Filiere</div>
                    <div class="info-value">{{ $evaluation->field_of_study }}@if($evaluation->start_year) ({{ $evaluation->start_year }})@endif</div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: EVALUATION -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon">&#10103;</div>
                <div class="section-title">Evaluation Globale</div>
            </div>
            <div class="rating-wrapper">
                <div class="rating-score-box">
                    <div class="rating-big">{{ $evaluation->rating }}</div>
                </div>
                <div class="rating-info-box">
                    <div class="rating-line">
                        <strong>Recommandation:</strong>
                        @if($evaluation->would_recommend)
                            <span class="badge badge-success">Recommande</span>
                        @else
                            <span class="badge badge-danger">Ne recommande pas</span>
                        @endif
                    </div>
                    <div class="rating-line">
                        <strong>Source de decouverte:</strong> {{ $evaluation->discovery_source_label }}
                        @if($evaluation->discovery_source_detail) ({{ $evaluation->discovery_source_detail }})@endif
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: DETAILS -->
        @if($evaluation->rating_accompagnement || $evaluation->rating_communication || $evaluation->rating_delais || $evaluation->rating_rapport_qualite_prix)
        <div class="section">
            <div class="section-header">
                <div class="section-icon">&#10104;</div>
                <div class="section-title">Evaluations Detaillees</div>
            </div>
            <table class="ratings-table">
                <tr>
                    <th>Accompagnement</th>
                    <th>Communication</th>
                    <th>Delais</th>
                    <th>Qualite/Prix</th>
                </tr>
                <tr>
                    <td><div class="score">{{ $evaluation->rating_accompagnement ?? '-' }}/5</div></td>
                    <td><div class="score">{{ $evaluation->rating_communication ?? '-' }}/5</div></td>
                    <td><div class="score">{{ $evaluation->rating_delais ?? '-' }}/5</div></td>
                    <td><div class="score">{{ $evaluation->rating_rapport_qualite_prix ?? '-' }}/5</div></td>
                </tr>
            </table>
        </div>
        @endif

        <!-- SECTION 4: TEMOIGNAGE -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon">&#10105;</div>
                <div class="section-title">Temoignage</div>
            </div>
            <div class="text-label">Parcours et experience:</div>
            <div class="text-box">{{ Str::limit($evaluation->project_story, 250) }}</div>
            @if($evaluation->comment)
            <div class="text-label" style="margin-top: 10px;">Commentaire supplementaire:</div>
            <div class="text-box">{{ Str::limit($evaluation->comment, 120) }}</div>
            @endif
        </div>

        <!-- SECTION 5: AUTHENTIFICATION -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon">&#10106;</div>
                <div class="section-title">Authentification</div>
            </div>
            <div class="auth-wrapper">
                <table class="signature-grid">
                    <tr>
                        <td>
                            <div class="signature-box">
                                <div class="signature-title">Signature du Beneficiaire</div>
                                <div class="signature-area">
                                    @if($signature)
                                        <img src="{{ $signature }}" alt="Signature" class="signature-img">
                                    @endif
                                </div>
                                <div class="signature-name">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</div>
                                @if($evaluation->signed_at)
                                <div class="signature-date">Signe le {{ $evaluation->signed_at->format('d/m/Y') }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="signature-box">
                                <div class="signature-title">Cachet de l'Organisme</div>
                                <div class="stamp-container">
                                    <div class="stamp-text">TRAVEL EXPRESS</div>
                                    <div class="stamp-subtitle">Service Qualite</div>
                                </div>
                                <div class="signature-name">Direction</div>
                                <div class="signature-date">{{ now()->format('d/m/Y') }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- LEGAL -->
        <div class="legal">
            <strong>Mentions legales:</strong> Ce document est une attestation officielle delivree par Travel Express. Les informations contenues sont fournies par le beneficiaire et attestent de son experience avec nos services. Toute falsification de ce document est passible de poursuites judiciaires.
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="footer-left">Travel Express - Agence d'Accompagnement International</td>
                <td class="footer-center">REF: TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td class="footer-right">Page 1/1 | {{ $generatedAt }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
