<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attestation - {{ $evaluation->first_name }} {{ $evaluation->last_name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

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
            font-size: 8.5pt;
            line-height: 1.3;
            color: #1a1a1a;
            background: #ffffff;
        }

        /* ===== HEADER LUXE NOIR & OR ===== */
        .header {
            background: #0a0a0a;
            color: white;
            padding: 20px 40px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #d4af37, #f4e4a6, #d4af37);
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
            background: linear-gradient(135deg, #d4af37, #f4e4a6);
            width: 50px;
            height: 50px;
            border-radius: 8px;
            text-align: center;
            line-height: 50px;
            font-size: 20pt;
            font-weight: 800;
            color: #0a0a0a;
            vertical-align: middle;
            margin-right: 18px;
            font-family: 'Poppins', sans-serif;
        }

        .logo-text {
            display: inline-block;
            vertical-align: middle;
        }

        .company-name {
            font-size: 20pt;
            font-weight: 700;
            letter-spacing: 4px;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            color: #ffffff;
        }

        .company-tagline {
            font-size: 7pt;
            color: #d4af37;
            letter-spacing: 3px;
            margin-top: 4px;
            text-transform: uppercase;
            font-weight: 500;
        }

        .doc-badge {
            display: inline-block;
            background: transparent;
            border: 2px solid #d4af37;
            color: #d4af37;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 8pt;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 20px 40px 15px 40px;
        }

        /* ===== TITLE ===== */
        .title-section {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f0f0;
        }

        .title-main {
            font-size: 16pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #0a0a0a;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        .title-sub {
            font-size: 7pt;
            color: #666666;
            margin-top: 4px;
            font-weight: 400;
            letter-spacing: 1px;
        }

        .doc-ref {
            font-size: 7pt;
            color: #d4af37;
            margin-top: 6px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 12px;
        }

        .section-header {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .section-number {
            display: table-cell;
            width: 24px;
            vertical-align: middle;
        }

        .num-circle {
            width: 18px;
            height: 18px;
            background: #0a0a0a;
            border-radius: 50%;
            text-align: center;
            line-height: 18px;
            color: #d4af37;
            font-size: 9pt;
            font-weight: 700;
        }

        .section-title-box {
            display: table-cell;
            vertical-align: middle;
            padding-left: 10px;
        }

        .section-title {
            font-size: 10pt;
            font-weight: 700;
            color: #0a0a0a;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        /* ===== TABLES ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-grid {
            width: 100%;
            margin-bottom: 12px;
        }

        .info-grid td {
            width: 50%;
            vertical-align: top;
            padding: 0 12px;
        }

        .info-grid td:first-child {
            padding-left: 0;
        }

        .info-grid td:last-child {
            padding-right: 0;
        }

        .info-table {
            width: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .info-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 8pt;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-table .label {
            background: #fafafa;
            font-weight: 600;
            width: 35%;
            color: #0a0a0a;
        }

        .info-table .value {
            width: 65%;
            color: #333333;
            font-weight: 400;
        }

        /* ===== RATING BOX ===== */
        .rating-section {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .rating-left {
            display: table-cell;
            width: 25%;
            vertical-align: middle;
        }

        .rating-right {
            display: table-cell;
            width: 75%;
            vertical-align: middle;
            padding-left: 20px;
        }

        .rating-box {
            background: #0a0a0a;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            border: 2px solid #d4af37;
        }

        .rating-score {
            font-size: 28pt;
            font-weight: 800;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            color: #d4af37;
        }

        .rating-max {
            font-size: 12pt;
            color: #888888;
            font-weight: 400;
        }

        .rating-label {
            font-size: 6pt;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 3px;
            font-weight: 600;
        }

        .info-line {
            font-size: 8pt;
            margin-bottom: 6px;
            padding: 8px 12px;
            background: #fafafa;
            border-left: 3px solid #d4af37;
            border-radius: 0 6px 6px 0;
        }

        .info-line strong {
            color: #0a0a0a;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-size: 6.5pt;
            font-weight: 700;
            border-radius: 15px;
            margin-left: 6px;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: #d4af37;
            color: #0a0a0a;
        }

        .badge-danger {
            background: #1a1a1a;
            color: #ffffff;
        }

        /* ===== RATINGS TABLE ===== */
        .ratings-table {
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #0a0a0a;
        }

        .ratings-table th {
            background: #0a0a0a;
            color: #d4af37;
            padding: 6px;
            font-size: 7pt;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .ratings-table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #f0f0f0;
            background: #fafafa;
        }

        .ratings-table .score {
            font-size: 13pt;
            font-weight: 800;
            color: #d4af37;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
        }

        /* ===== TEXT BOX ===== */
        .text-box {
            background: #fafafa;
            border: 1px solid #e0e0e0;
            border-left: 4px solid #0a0a0a;
            padding: 10px 14px;
            font-size: 8pt;
            line-height: 1.5;
            border-radius: 0 8px 8px 0;
            color: #333333;
        }

        .text-label {
            font-size: 6.5pt;
            color: #888888;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* ===== SIGNATURE SECTION ===== */
        .signature-section {
            margin-top: 15px;
            padding-top: 12px;
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
            border: 2px solid #0a0a0a;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            min-height: 130px;
            background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
        }

        .signature-title {
            font-size: 7pt;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .signature-img {
            max-height: 90px;
            max-width: 220px;
            margin: 8px auto;
            display: block;
        }

        .signature-name {
            font-size: 11pt;
            font-weight: 700;
            color: #0a0a0a;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 2px solid #d4af37;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            letter-spacing: 1px;
        }

        .signature-date {
            font-size: 8pt;
            color: #666666;
            margin-top: 4px;
            font-weight: 500;
        }

        .stamp-text {
            font-size: 12pt;
            font-weight: 800;
            color: #0a0a0a;
            margin: 12px 0;
            font-family: 'Poppins', 'DejaVu Sans', sans-serif;
            letter-spacing: 2px;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #0a0a0a;
            color: white;
            padding: 10px 40px;
        }

        .footer-table {
            width: 100%;
        }

        .footer-left {
            font-size: 7pt;
            color: #888888;
            font-weight: 400;
        }

        .footer-center {
            text-align: center;
            font-size: 9pt;
            color: #d4af37;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .footer-right {
            text-align: right;
            font-size: 7pt;
            color: #888888;
            font-weight: 400;
        }

        /* ===== LEGAL ===== */
        .legal {
            margin-top: 12px;
            padding: 10px 14px;
            background: #0a0a0a;
            border-radius: 6px;
            font-size: 6.5pt;
            color: #888888;
            line-height: 1.5;
        }

        .legal strong {
            color: #d4af37;
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
                        @if($evaluation->discovery_source_detail) ({{ $evaluation->discovery_source_detail }})@endif
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
            <div class="text-box">{{ Str::limit($evaluation->project_story, 200) }}</div>
            @if($evaluation->comment)
            <div class="text-label" style="margin-top: 8px;">Commentaire:</div>
            <div class="text-box">{{ Str::limit($evaluation->comment, 100) }}</div>
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
                                <div style="height: 50px;"></div>
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
            Les informations contenues sont fournies par le beneficiaire. Toute falsification est passible de poursuites.
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="footer-left">Travel Express - Agence Internationale</td>
                <td class="footer-center">TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td class="footer-right">Page 1/1 | {{ $generatedAt }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
