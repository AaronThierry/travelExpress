<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attestation d'Evaluation - {{ $evaluation->first_name }} {{ $evaluation->last_name }}</title>
    <style>
        @page {
            margin: 20mm 15mm 25mm 15mm;
            size: A4 portrait;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #000000;
            background: #ffffff;
        }

        /* ===== EN-TETE OFFICIEL ===== */
        .header {
            border-bottom: 2px solid #000000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header-row {
            display: table;
            width: 100%;
        }

        .header-left {
            display: table-cell;
            width: 70%;
            vertical-align: top;
        }

        .header-right {
            display: table-cell;
            width: 30%;
            vertical-align: top;
            text-align: right;
        }

        .org-name {
            font-size: 16pt;
            font-weight: bold;
            color: #1a5d4a;
            letter-spacing: 1px;
        }

        .org-type {
            font-size: 9pt;
            color: #333333;
            margin-top: 3px;
        }

        .org-contact {
            font-size: 8pt;
            color: #666666;
            margin-top: 8px;
            line-height: 1.5;
        }

        .doc-ref {
            font-size: 8pt;
            color: #333333;
            text-align: right;
        }

        .doc-ref-label {
            font-weight: bold;
        }

        /* ===== TITRE DU DOCUMENT ===== */
        .doc-title {
            text-align: center;
            margin: 25px 0;
            padding: 15px 0;
            border-top: 1px solid #cccccc;
            border-bottom: 1px solid #cccccc;
        }

        .doc-title h1 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #000000;
        }

        .doc-title-sub {
            font-size: 9pt;
            color: #666666;
            margin-top: 5px;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 10pt;
            font-weight: bold;
            color: #1a5d4a;
            text-transform: uppercase;
            border-bottom: 1px solid #1a5d4a;
            padding-bottom: 4px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        /* ===== TABLEAUX ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table.info-table td {
            padding: 6px 8px;
            vertical-align: top;
            border: 1px solid #cccccc;
        }

        table.info-table td.label {
            background: #f5f5f5;
            font-weight: bold;
            width: 35%;
            font-size: 9pt;
        }

        table.info-table td.value {
            width: 65%;
            font-size: 9pt;
        }

        table.ratings-table {
            margin-top: 10px;
        }

        table.ratings-table th {
            background: #1a5d4a;
            color: white;
            padding: 8px;
            font-size: 8pt;
            font-weight: bold;
            text-align: center;
            border: 1px solid #1a5d4a;
        }

        table.ratings-table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #cccccc;
            font-size: 9pt;
        }

        table.ratings-table td.score {
            font-weight: bold;
            font-size: 11pt;
            color: #1a5d4a;
        }

        /* ===== TEXTE ===== */
        .text-block {
            background: #fafafa;
            border: 1px solid #e0e0e0;
            padding: 12px;
            font-size: 9pt;
            line-height: 1.6;
            text-align: justify;
        }

        .text-label {
            font-size: 8pt;
            color: #666666;
            font-style: italic;
            margin-bottom: 5px;
        }

        /* ===== INDICATEURS ===== */
        .indicator {
            display: inline-block;
            padding: 3px 10px;
            font-size: 8pt;
            font-weight: bold;
            border-radius: 3px;
        }

        .indicator-positive {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .indicator-negative {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* ===== SIGNATURE ===== */
        .signature-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-row {
            display: table;
            width: 100%;
            margin-top: 20px;
        }

        .signature-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .signature-box {
            border: 1px solid #cccccc;
            padding: 15px;
            min-height: 100px;
            text-align: center;
        }

        .signature-label {
            font-size: 8pt;
            color: #666666;
            margin-bottom: 10px;
        }

        .signature-img {
            max-height: 60px;
            max-width: 150px;
        }

        .signature-name {
            font-size: 9pt;
            font-weight: bold;
            margin-top: 10px;
            border-top: 1px solid #000000;
            padding-top: 5px;
        }

        .signature-date {
            font-size: 8pt;
            color: #666666;
            margin-top: 5px;
        }

        /* ===== PIED DE PAGE ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #cccccc;
            padding-top: 10px;
            font-size: 7pt;
            color: #666666;
        }

        .footer-row {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            width: 60%;
            text-align: left;
        }

        .footer-right {
            display: table-cell;
            width: 40%;
            text-align: right;
        }

        /* ===== NOTE GLOBALE ===== */
        .global-rating {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border: 2px solid #1a5d4a;
            margin: 15px 0;
        }

        .global-rating-score {
            font-size: 28pt;
            font-weight: bold;
            color: #1a5d4a;
        }

        .global-rating-max {
            font-size: 14pt;
            color: #666666;
        }

        .global-rating-label {
            font-size: 9pt;
            color: #333333;
            margin-top: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ===== MENTIONS LEGALES ===== */
        .legal-notice {
            margin-top: 20px;
            padding: 10px;
            background: #f5f5f5;
            border-left: 3px solid #1a5d4a;
            font-size: 7pt;
            color: #666666;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <!-- EN-TETE -->
    <div class="header">
        <div class="header-row">
            <div class="header-left">
                <div class="org-name">TRAVEL EXPRESS</div>
                <div class="org-type">Agence d'Accompagnement pour les Etudes Internationales</div>
                <div class="org-contact">
                    Email: contact@travelexpress.com<br>
                    Site web: www.travelexpress.com
                </div>
            </div>
            <div class="header-right">
                <div class="doc-ref">
                    <span class="doc-ref-label">Reference:</span><br>
                    TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}<br><br>
                    <span class="doc-ref-label">Date d'emission:</span><br>
                    {{ $generatedAt }}
                </div>
            </div>
        </div>
    </div>

    <!-- TITRE -->
    <div class="doc-title">
        <h1>Attestation d'Evaluation</h1>
        <div class="doc-title-sub">Fiche de satisfaction client - Document officiel</div>
    </div>

    <!-- SECTION 1: INFORMATIONS PERSONNELLES -->
    <div class="section">
        <div class="section-title">1. Informations du Beneficiaire</div>
        <table class="info-table">
            <tr>
                <td class="label">Nom complet</td>
                <td class="value">{{ $evaluation->first_name }} {{ $evaluation->last_name }}</td>
            </tr>
            <tr>
                <td class="label">Adresse email</td>
                <td class="value">{{ $evaluation->email }}</td>
            </tr>
            @if($evaluation->phone)
            <tr>
                <td class="label">Telephone</td>
                <td class="value">{{ $evaluation->phone }}</td>
            </tr>
            @endif
            <tr>
                <td class="label">Service utilise</td>
                <td class="value">{{ ucfirst($evaluation->service_used ?? 'Etudes') }}</td>
            </tr>
        </table>
    </div>

    <!-- SECTION 2: PARCOURS ACADEMIQUE -->
    <div class="section">
        <div class="section-title">2. Parcours Academique</div>
        <table class="info-table">
            <tr>
                <td class="label">Universite / Etablissement</td>
                <td class="value">{{ $evaluation->university }}</td>
            </tr>
            <tr>
                <td class="label">Pays d'etude</td>
                <td class="value">{{ $evaluation->country_of_study }}</td>
            </tr>
            <tr>
                <td class="label">Niveau d'etude</td>
                <td class="value">{{ $evaluation->study_level_label }}</td>
            </tr>
            <tr>
                <td class="label">Filiere / Domaine</td>
                <td class="value">{{ $evaluation->field_of_study }}</td>
            </tr>
            @if($evaluation->start_year)
            <tr>
                <td class="label">Annee de debut</td>
                <td class="value">{{ $evaluation->start_year }}</td>
            </tr>
            @endif
        </table>
    </div>

    <!-- SECTION 3: EVALUATION GLOBALE -->
    <div class="section">
        <div class="section-title">3. Evaluation Globale</div>
        <div class="global-rating">
            <div class="global-rating-score">{{ $evaluation->rating }}<span class="global-rating-max"> / 5</span></div>
            <div class="global-rating-label">Note de satisfaction globale</div>
        </div>

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                    <strong>Recommandation:</strong><br>
                    @if($evaluation->would_recommend)
                        <span class="indicator indicator-positive">OUI - Recommande Travel Express</span>
                    @else
                        <span class="indicator indicator-negative">NON - Ne recommande pas</span>
                    @endif
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <strong>Source de decouverte:</strong><br>
                    <span style="font-size: 9pt;">{{ $evaluation->discovery_source_label }}</span>
                    @if($evaluation->discovery_source_detail)
                        <br><span style="font-size: 8pt; color: #666;">({{ $evaluation->discovery_source_detail }})</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- SECTION 4: EVALUATIONS DETAILLEES -->
    @if($evaluation->rating_accompagnement || $evaluation->rating_communication || $evaluation->rating_delais || $evaluation->rating_rapport_qualite_prix)
    <div class="section">
        <div class="section-title">4. Evaluations Detaillees par Critere</div>
        <table class="ratings-table">
            <thead>
                <tr>
                    <th>Critere</th>
                    <th>Note</th>
                    <th>Appreciation</th>
                </tr>
            </thead>
            <tbody>
                @if($evaluation->rating_accompagnement)
                <tr>
                    <td>Qualite de l'accompagnement</td>
                    <td class="score">{{ $evaluation->rating_accompagnement }} / 5</td>
                    <td>{{ $evaluation->rating_accompagnement >= 4 ? 'Excellent' : ($evaluation->rating_accompagnement >= 3 ? 'Satisfaisant' : 'A ameliorer') }}</td>
                </tr>
                @endif
                @if($evaluation->rating_communication)
                <tr>
                    <td>Communication</td>
                    <td class="score">{{ $evaluation->rating_communication }} / 5</td>
                    <td>{{ $evaluation->rating_communication >= 4 ? 'Excellent' : ($evaluation->rating_communication >= 3 ? 'Satisfaisant' : 'A ameliorer') }}</td>
                </tr>
                @endif
                @if($evaluation->rating_delais)
                <tr>
                    <td>Respect des delais</td>
                    <td class="score">{{ $evaluation->rating_delais }} / 5</td>
                    <td>{{ $evaluation->rating_delais >= 4 ? 'Excellent' : ($evaluation->rating_delais >= 3 ? 'Satisfaisant' : 'A ameliorer') }}</td>
                </tr>
                @endif
                @if($evaluation->rating_rapport_qualite_prix)
                <tr>
                    <td>Rapport qualite / prix</td>
                    <td class="score">{{ $evaluation->rating_rapport_qualite_prix }} / 5</td>
                    <td>{{ $evaluation->rating_rapport_qualite_prix >= 4 ? 'Excellent' : ($evaluation->rating_rapport_qualite_prix >= 3 ? 'Satisfaisant' : 'A ameliorer') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @endif

    <!-- SECTION 5: TEMOIGNAGE -->
    <div class="section">
        <div class="section-title">5. Temoignage et Commentaires</div>

        <div class="text-label">Description du parcours:</div>
        <div class="text-block">
            {{ $evaluation->project_story }}
        </div>

        @if($evaluation->comment)
        <div style="margin-top: 10px;">
            <div class="text-label">Commentaires additionnels:</div>
            <div class="text-block">
                {{ $evaluation->comment }}
            </div>
        </div>
        @endif

        @if($evaluation->public_testimonial)
        <div style="margin-top: 10px;">
            <div class="text-label">Temoignage public autorise:</div>
            <div class="text-block" style="font-style: italic;">
                "{{ $evaluation->public_testimonial }}"
            </div>
        </div>
        @endif
    </div>

    <!-- SECTION 6: SIGNATURE -->
    <div class="signature-section">
        <div class="section-title">6. Authentification</div>
        <div class="signature-row">
            <div class="signature-col" style="padding-right: 15px;">
                <div class="signature-box">
                    <div class="signature-label">Signature du beneficiaire</div>
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
            </div>
            <div class="signature-col" style="padding-left: 15px;">
                <div class="signature-box">
                    <div class="signature-label">Cachet de l'organisme</div>
                    <div style="height: 40px; display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 10pt; font-weight: bold; color: #1a5d4a;">TRAVEL EXPRESS</span>
                    </div>
                    <div class="signature-name">Service Qualite</div>
                    <div class="signature-date">{{ now()->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MENTIONS LEGALES -->
    <div class="legal-notice">
        <strong>Mentions legales:</strong> Ce document est une attestation officielle delivree par Travel Express.
        Les informations contenues dans ce document sont fournies par le beneficiaire et attestent de son experience avec nos services.
        Toute falsification de ce document est passible de poursuites.
        Document genere automatiquement - Reference: TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}
    </div>

    <!-- PIED DE PAGE -->
    <div class="footer">
        <div class="footer-row">
            <div class="footer-left">
                Travel Express - Agence d'Accompagnement pour les Etudes Internationales<br>
                Document officiel - Ref: TE-EVAL-{{ str_pad($evaluation->id, 5, '0', STR_PAD_LEFT) }}
            </div>
            <div class="footer-right">
                Page 1/1<br>
                Genere le {{ $generatedAt }}
            </div>
        </div>
    </div>
</body>
</html>
