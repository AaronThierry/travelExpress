<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attestation - {{ $evaluation->first_name }} {{ $evaluation->last_name }}</title>
    <style>
        @page {
            margin: 12mm 12mm 15mm 12mm;
            size: A4 portrait;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 8pt;
            line-height: 1.3;
            color: #2c3e50;
            background: #ffffff;
        }

        /* ===== EN-TETE ===== */
        .header {
            border-bottom: 2px solid #1a5d4a;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .header-table {
            width: 100%;
        }

        .header-left {
            width: 65%;
        }

        .header-right {
            width: 35%;
            text-align: right;
            vertical-align: top;
        }

        .company-name {
            font-size: 15pt;
            font-weight: bold;
            color: #1a5d4a;
            letter-spacing: 2px;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .company-desc {
            font-size: 7pt;
            color: #7f8c8d;
            margin-top: 2px;
            font-style: italic;
        }

        .doc-info {
            font-size: 7pt;
            color: #555;
        }

        .doc-info strong {
            color: #1a5d4a;
        }

        .doc-ref {
            font-size: 9pt;
            font-weight: bold;
            color: #1a5d4a;
            font-family: 'DejaVu Sans Mono', monospace;
        }

        /* ===== TITRE ===== */
        .title-section {
            text-align: center;
            margin: 10px 0;
            padding: 8px 0;
            border-top: 1px solid #bdc3c7;
            border-bottom: 1px solid #bdc3c7;
        }

        .title-main {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #2c3e50;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .title-sub {
            font-size: 7pt;
            color: #7f8c8d;
            margin-top: 3px;
            font-style: italic;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 8px;
        }

        .section-title {
            font-size: 8pt;
            font-weight: bold;
            color: #1a5d4a;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #1a5d4a;
            padding-bottom: 2px;
            margin-bottom: 5px;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        /* ===== TABLEAUX ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 3px 5px;
            border: 1px solid #ddd;
            font-size: 7.5pt;
        }

        .info-table .label {
            background: #f8f9fa;
            font-weight: bold;
            width: 30%;
            color: #2c3e50;
        }

        .info-table .value {
            width: 70%;
            color: #34495e;
        }

        /* Deux colonnes */
        .two-col-table {
            width: 100%;
        }

        .two-col-table td {
            width: 50%;
            vertical-align: top;
            padding: 0 5px;
        }

        .two-col-table td:first-child {
            padding-left: 0;
        }

        .two-col-table td:last-child {
            padding-right: 0;
        }

        .two-col-table .info-table {
            width: 100%;
        }

        /* ===== NOTE GLOBALE ===== */
        .rating-box {
            text-align: center;
            padding: 8px;
            background: linear-gradient(135deg, #f8f9fa, #ecf0f1);
            border: 2px solid #1a5d4a;
            border-radius: 5px;
            margin: 5px 0;
        }

        .rating-score {
            font-size: 22pt;
            font-weight: bold;
            color: #1a5d4a;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .rating-max {
            font-size: 12pt;
            color: #7f8c8d;
        }

        .rating-label {
            font-size: 7pt;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        /* ===== EVALUATIONS DETAILLEES ===== */
        .ratings-table th {
            background: #1a5d4a;
            color: white;
            padding: 4px;
            font-size: 7pt;
            font-weight: bold;
            text-align: center;
        }

        .ratings-table td {
            padding: 4px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 7.5pt;
        }

        .ratings-table .score {
            font-weight: bold;
            color: #1a5d4a;
            font-size: 9pt;
        }

        /* ===== BADGES ===== */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            font-size: 7pt;
            font-weight: bold;
            border-radius: 3px;
        }

        .badge-success {
            background: #d5f4e6;
            color: #1a5d4a;
            border: 1px solid #a8e6cf;
        }

        .badge-danger {
            background: #ffeaea;
            color: #c0392b;
            border: 1px solid #f5b7b1;
        }

        /* ===== TEXTE ===== */
        .text-box {
            background: #fafafa;
            border: 1px solid #e0e0e0;
            padding: 6px 8px;
            font-size: 7.5pt;
            line-height: 1.4;
            border-radius: 3px;
        }

        .text-label {
            font-size: 6.5pt;
            color: #7f8c8d;
            font-style: italic;
            margin-bottom: 2px;
        }

        /* ===== SIGNATURES ===== */
        .signature-table {
            width: 100%;
            margin-top: 8px;
        }

        .signature-table td {
            width: 48%;
            vertical-align: top;
        }

        .signature-box {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            min-height: 70px;
            border-radius: 3px;
        }

        .signature-title {
            font-size: 6.5pt;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .signature-img {
            max-height: 35px;
            max-width: 120px;
        }

        .signature-name {
            font-size: 8pt;
            font-weight: bold;
            margin-top: 5px;
            padding-top: 5px;
            border-top: 1px solid #2c3e50;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .signature-date {
            font-size: 6.5pt;
            color: #7f8c8d;
        }

        /* ===== MENTIONS LEGALES ===== */
        .legal {
            margin-top: 8px;
            padding: 5px 8px;
            background: #f8f9fa;
            border-left: 3px solid #1a5d4a;
            font-size: 6pt;
            color: #7f8c8d;
            line-height: 1.4;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 6pt;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding-top: 5px;
        }

        .footer-table {
            width: 100%;
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }

        /* ===== INLINE LAYOUT ===== */
        .inline-info {
            font-size: 7.5pt;
            margin-top: 5px;
        }

        .inline-info strong {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <!-- EN-TETE -->
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="company-name">TRAVEL EXPRESS</div>
                    <div class="company-desc">Agence d'Accompagnement pour les Etudes Internationales</div>
                </td>
                <td class="header-right">
                    <div class="doc-info">
                        <strong>Ref:</strong> <span class="doc-ref">TE-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}</span><br>
                        <strong>Date:</strong> {{ $generatedAt }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- TITRE -->
    <div class="title-section">
        <div class="title-main">Attestation d'Evaluation</div>
        <div class="title-sub">Document officiel de satisfaction client</div>
    </div>

    <!-- SECTION 1 & 2: INFOS EN DEUX COLONNES -->
    <table class="two-col-table">
        <tr>
            <td>
                <div class="section">
                    <div class="section-title">Beneficiaire</div>
                    <table class="info-table">
                        <tr><td class="label">Nom</td><td class="value">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</td></tr>
                        <tr><td class="label">Email</td><td class="value">{{ $evaluation->email }}</td></tr>
                        <tr><td class="label">Service</td><td class="value">{{ ucfirst($evaluation->service_used ?? 'Etudes') }}</td></tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="section">
                    <div class="section-title">Parcours Academique</div>
                    <table class="info-table">
                        <tr><td class="label">Universite</td><td class="value">{{ $evaluation->university }}</td></tr>
                        <tr><td class="label">Pays</td><td class="value">{{ $evaluation->country_of_study }}</td></tr>
                        <tr><td class="label">Niveau</td><td class="value">{{ $evaluation->study_level_label }}</td></tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- SECTION 3: EVALUATION GLOBALE -->
    <div class="section">
        <div class="section-title">Evaluation</div>
        <table class="two-col-table">
            <tr>
                <td style="width: 35%;">
                    <div class="rating-box">
                        <div class="rating-score">{{ $evaluation->rating }}<span class="rating-max">/5</span></div>
                        <div class="rating-label">Note globale</div>
                    </div>
                </td>
                <td style="width: 65%; padding-left: 10px;">
                    <div class="inline-info">
                        <strong>Recommandation:</strong>
                        @if($evaluation->would_recommend)
                            <span class="badge badge-success">OUI</span>
                        @else
                            <span class="badge badge-danger">NON</span>
                        @endif
                    </div>
                    <div class="inline-info">
                        <strong>Source:</strong> {{ $evaluation->discovery_source_label }}
                    </div>
                    <div class="inline-info">
                        <strong>Filiere:</strong> {{ $evaluation->field_of_study }}
                        @if($evaluation->start_year)
                        | <strong>Annee:</strong> {{ $evaluation->start_year }}
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- SECTION 4: EVALUATIONS DETAILLEES -->
    @if($evaluation->rating_accompagnement || $evaluation->rating_communication || $evaluation->rating_delais || $evaluation->rating_rapport_qualite_prix)
    <div class="section">
        <div class="section-title">Evaluations Detaillees</div>
        <table class="ratings-table">
            <tr>
                <th style="width: 25%;">Accompagnement</th>
                <th style="width: 25%;">Communication</th>
                <th style="width: 25%;">Delais</th>
                <th style="width: 25%;">Qualite/Prix</th>
            </tr>
            <tr>
                <td class="score">{{ $evaluation->rating_accompagnement ?? '-' }}/5</td>
                <td class="score">{{ $evaluation->rating_communication ?? '-' }}/5</td>
                <td class="score">{{ $evaluation->rating_delais ?? '-' }}/5</td>
                <td class="score">{{ $evaluation->rating_rapport_qualite_prix ?? '-' }}/5</td>
            </tr>
        </table>
    </div>
    @endif

    <!-- SECTION 5: TEMOIGNAGE -->
    <div class="section">
        <div class="section-title">Temoignage</div>
        <div class="text-label">Parcours:</div>
        <div class="text-box">{{ Str::limit($evaluation->project_story, 300) }}</div>
        @if($evaluation->comment)
        <div class="text-label" style="margin-top: 5px;">Commentaire:</div>
        <div class="text-box">{{ Str::limit($evaluation->comment, 150) }}</div>
        @endif
    </div>

    <!-- SECTION 6: SIGNATURES -->
    <div class="section">
        <div class="section-title">Authentification</div>
        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-box">
                        <div class="signature-title">Signature du beneficiaire</div>
                        @if($signature)
                            <img src="{{ $signature }}" alt="Signature" class="signature-img">
                        @else
                            <div style="height: 25px;"></div>
                        @endif
                        <div class="signature-name">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</div>
                        @if($evaluation->signed_at)
                        <div class="signature-date">{{ $evaluation->signed_at->format('d/m/Y') }}</div>
                        @endif
                    </div>
                </td>
                <td style="width: 4%;"></td>
                <td>
                    <div class="signature-box">
                        <div class="signature-title">Cachet de l'organisme</div>
                        <div style="font-size: 9pt; font-weight: bold; color: #1a5d4a; margin: 8px 0;">TRAVEL EXPRESS</div>
                        <div class="signature-name">Service Qualite</div>
                        <div class="signature-date">{{ now()->format('d/m/Y') }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- MENTIONS LEGALES -->
    <div class="legal">
        <strong>Mentions legales:</strong> Attestation officielle delivree par Travel Express. Les informations sont fournies par le beneficiaire.
        Toute falsification est passible de poursuites. Ref: TE-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="footer-left">Travel Express - Document officiel</td>
                <td class="footer-right">Page 1/1 | {{ $generatedAt }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
