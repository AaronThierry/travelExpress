<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attestation - {{ $evaluation->first_name }} {{ $evaluation->last_name }}</title>
    <style>
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
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.4;
            color: #2c3e50;
            background: #ffffff;
        }

        /* ===== HEADER PREMIUM ===== */
        .header {
            background: #0d3b2d;
            color: white;
            padding: 25px 40px;
            position: relative;
        }

        .header-table {
            width: 100%;
        }

        .header-left {
            width: 60%;
            vertical-align: middle;
        }

        .header-right {
            width: 40%;
            text-align: right;
            vertical-align: middle;
        }

        .logo-box {
            display: inline-block;
            background: #c9a227;
            width: 45px;
            height: 45px;
            border-radius: 8px;
            text-align: center;
            line-height: 45px;
            font-size: 18pt;
            font-weight: bold;
            color: #0d3b2d;
            vertical-align: middle;
            margin-right: 15px;
        }

        .logo-text {
            display: inline-block;
            vertical-align: middle;
        }

        .company-name {
            font-size: 18pt;
            font-weight: bold;
            letter-spacing: 3px;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .company-tagline {
            font-size: 7pt;
            color: #c9a227;
            letter-spacing: 2px;
            margin-top: 3px;
            text-transform: uppercase;
        }

        .doc-badge {
            display: inline-block;
            background: rgba(201, 162, 39, 0.15);
            border: 2px solid #c9a227;
            color: #c9a227;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 9pt;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .gold-bar {
            height: 4px;
            background: #c9a227;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 25px 40px 20px 40px;
        }

        /* ===== TITLE ===== */
        .title-section {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .title-main {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #0d3b2d;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .title-sub {
            font-size: 8pt;
            color: #7f8c8d;
            margin-top: 5px;
            font-style: italic;
        }

        .doc-ref {
            font-size: 8pt;
            color: #0d3b2d;
            margin-top: 8px;
            font-family: 'DejaVu Sans Mono', monospace;
            font-weight: bold;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 15px;
        }

        .section-header {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .section-number {
            display: table-cell;
            width: 25px;
            vertical-align: middle;
        }

        .num-circle {
            width: 20px;
            height: 20px;
            background: #0d3b2d;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            color: white;
            font-size: 9pt;
            font-weight: bold;
        }

        .section-title-box {
            display: table-cell;
            vertical-align: middle;
            padding-left: 10px;
        }

        .section-title {
            font-size: 10pt;
            font-weight: bold;
            color: #0d3b2d;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        /* ===== TABLES ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-grid {
            width: 100%;
            margin-bottom: 10px;
        }

        .info-grid td {
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }

        .info-grid td:first-child {
            padding-left: 0;
        }

        .info-grid td:last-child {
            padding-right: 0;
        }

        .info-table {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .info-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #eee;
            font-size: 8pt;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-table .label {
            background: #f8f9fa;
            font-weight: bold;
            width: 35%;
            color: #0d3b2d;
        }

        .info-table .value {
            width: 65%;
            color: #34495e;
        }

        /* ===== RATING BOX ===== */
        .rating-section {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .rating-left {
            display: table-cell;
            width: 30%;
            vertical-align: middle;
        }

        .rating-right {
            display: table-cell;
            width: 70%;
            vertical-align: middle;
            padding-left: 20px;
        }

        .rating-box {
            background: linear-gradient(135deg, #0d3b2d 0%, #1a5d4a 100%);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            color: white;
        }

        .rating-score {
            font-size: 32pt;
            font-weight: bold;
            font-family: 'DejaVu Serif', Georgia, serif;
            color: #c9a227;
        }

        .rating-max {
            font-size: 14pt;
            color: rgba(255,255,255,0.7);
        }

        .rating-label {
            font-size: 7pt;
            color: rgba(255,255,255,0.8);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 5px;
        }

        .info-line {
            font-size: 8.5pt;
            margin-bottom: 8px;
            padding: 8px 12px;
            background: #f8f9fa;
            border-left: 3px solid #0d3b2d;
            border-radius: 0 5px 5px 0;
        }

        .info-line strong {
            color: #0d3b2d;
        }

        .badge {
            display: inline-block;
            padding: 3px 12px;
            font-size: 7pt;
            font-weight: bold;
            border-radius: 15px;
            margin-left: 5px;
        }

        .badge-success {
            background: #d5f4e6;
            color: #0d3b2d;
        }

        .badge-danger {
            background: #ffeaea;
            color: #c0392b;
        }

        /* ===== RATINGS TABLE ===== */
        .ratings-table {
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .ratings-table th {
            background: #0d3b2d;
            color: white;
            padding: 8px;
            font-size: 7.5pt;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .ratings-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #eee;
            background: #fafafa;
        }

        .ratings-table .score {
            font-size: 14pt;
            font-weight: bold;
            color: #c9a227;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .ratings-table .score-label {
            font-size: 7pt;
            color: #7f8c8d;
        }

        /* ===== TEXT BOX ===== */
        .text-box {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-left: 4px solid #0d3b2d;
            padding: 12px 15px;
            font-size: 8.5pt;
            line-height: 1.6;
            border-radius: 0 8px 8px 0;
            color: #34495e;
        }

        .text-label {
            font-size: 7pt;
            color: #7f8c8d;
            font-style: italic;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== SIGNATURE SECTION ===== */
        .signature-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #e0e0e0;
        }

        .signature-grid {
            width: 100%;
        }

        .signature-grid td {
            width: 46%;
            vertical-align: top;
        }

        .signature-grid td.spacer {
            width: 8%;
        }

        .signature-box {
            border: 2px solid #0d3b2d;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            min-height: 120px;
            background: linear-gradient(135deg, #fafafa 0%, #f0f0f0 100%);
        }

        .signature-title {
            font-size: 7pt;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .signature-img {
            max-height: 50px;
            max-width: 150px;
            margin: 10px 0;
        }

        .signature-name {
            font-size: 11pt;
            font-weight: bold;
            color: #0d3b2d;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #0d3b2d;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .signature-date {
            font-size: 8pt;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .stamp-text {
            font-size: 12pt;
            font-weight: bold;
            color: #0d3b2d;
            margin: 15px 0;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #0d3b2d;
            color: white;
            padding: 12px 40px;
        }

        .footer-table {
            width: 100%;
        }

        .footer-left {
            font-size: 7pt;
            color: rgba(255,255,255,0.7);
        }

        .footer-center {
            text-align: center;
            font-size: 8pt;
            color: #c9a227;
            font-weight: bold;
        }

        .footer-right {
            text-align: right;
            font-size: 7pt;
            color: rgba(255,255,255,0.7);
        }

        /* ===== LEGAL ===== */
        .legal {
            margin-top: 15px;
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 5px;
            font-size: 6.5pt;
            color: #7f8c8d;
            line-height: 1.5;
            border-left: 3px solid #c9a227;
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
    <div class="gold-bar"></div>

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
                <div class="section-number"><div class="num-circle">1</div></div>
                <div class="section-title-box"><div class="section-title">Informations</div></div>
            </div>
            <table class="info-grid">
                <tr>
                    <td>
                        <table class="info-table">
                            <tr><td class="label">Nom complet</td><td class="value">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</td></tr>
                            <tr><td class="label">Email</td><td class="value">{{ $evaluation->email }}</td></tr>
                            <tr><td class="label">Service</td><td class="value">{{ ucfirst($evaluation->service_used ?? 'Etudes') }}</td></tr>
                        </table>
                    </td>
                    <td>
                        <table class="info-table">
                            <tr><td class="label">Universite</td><td class="value">{{ $evaluation->university }}</td></tr>
                            <tr><td class="label">Pays / Niveau</td><td class="value">{{ $evaluation->country_of_study }} - {{ $evaluation->study_level_label }}</td></tr>
                            <tr><td class="label">Filiere</td><td class="value">{{ $evaluation->field_of_study }}@if($evaluation->start_year) ({{ $evaluation->start_year }})@endif</td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- SECTION 2: EVALUATION -->
        <div class="section">
            <div class="section-header">
                <div class="section-number"><div class="num-circle">2</div></div>
                <div class="section-title-box"><div class="section-title">Evaluation Globale</div></div>
            </div>
            <div class="rating-section">
                <div class="rating-left">
                    <div class="rating-box">
                        <div class="rating-score">{{ $evaluation->rating }}<span class="rating-max">/5</span></div>
                        <div class="rating-label">Note Globale</div>
                    </div>
                </div>
                <div class="rating-right">
                    <div class="info-line">
                        <strong>Recommandation:</strong>
                        @if($evaluation->would_recommend)
                            <span class="badge badge-success">RECOMMANDE</span>
                        @else
                            <span class="badge badge-danger">NE RECOMMANDE PAS</span>
                        @endif
                    </div>
                    <div class="info-line">
                        <strong>Source de decouverte:</strong> {{ $evaluation->discovery_source_label }}
                        @if($evaluation->discovery_source_detail)({{ $evaluation->discovery_source_detail }})@endif
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: DETAILS -->
        @if($evaluation->rating_accompagnement || $evaluation->rating_communication || $evaluation->rating_delais || $evaluation->rating_rapport_qualite_prix)
        <div class="section">
            <div class="section-header">
                <div class="section-number"><div class="num-circle">3</div></div>
                <div class="section-title-box"><div class="section-title">Evaluations Detaillees</div></div>
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
                <div class="section-number"><div class="num-circle">{{ $evaluation->rating_accompagnement ? '4' : '3' }}</div></div>
                <div class="section-title-box"><div class="section-title">Temoignage</div></div>
            </div>
            <div class="text-label">Parcours et experience:</div>
            <div class="text-box">{{ Str::limit($evaluation->project_story, 350) }}</div>
            @if($evaluation->comment)
            <div class="text-label" style="margin-top: 8px;">Commentaire supplementaire:</div>
            <div class="text-box">{{ Str::limit($evaluation->comment, 200) }}</div>
            @endif
        </div>

        <!-- SECTION 5: SIGNATURES -->
        <div class="signature-section">
            <div class="section-header">
                <div class="section-number"><div class="num-circle">{{ $evaluation->rating_accompagnement ? '5' : '4' }}</div></div>
                <div class="section-title-box"><div class="section-title">Authentification</div></div>
            </div>
            <table class="signature-grid">
                <tr>
                    <td>
                        <div class="signature-box">
                            <div class="signature-title">Signature du Beneficiaire</div>
                            @if($signature)
                                <img src="{{ $signature }}" alt="Signature" class="signature-img">
                            @else
                                <div style="height: 40px;"></div>
                            @endif
                            <div class="signature-name">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</div>
                            @if($evaluation->signed_at)
                            <div class="signature-date">Signe le {{ $evaluation->signed_at->format('d/m/Y') }}</div>
                            @endif
                        </div>
                    </td>
                    <td class="spacer"></td>
                    <td>
                        <div class="signature-box">
                            <div class="signature-title">Cachet de l'Organisme</div>
                            <div class="stamp-text">TRAVEL EXPRESS</div>
                            <div class="signature-name">Service Qualite</div>
                            <div class="signature-date">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- LEGAL -->
        <div class="legal">
            <strong>Mentions legales:</strong> Ce document est une attestation officielle delivree par Travel Express.
            Les informations contenues sont fournies par le beneficiaire et attestent de son experience avec nos services.
            Toute falsification de ce document est passible de poursuites judiciaires.
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
