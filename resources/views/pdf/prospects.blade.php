<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Export Prospects — Travel Express</title>
    <style>
        @page { margin: 0; size: A4 landscape; }
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 8.5pt;
            color: #1a1a1a;
            background: #fff;
        }

        /* ── Header ── */
        .header {
            background: #0a0a0a;
            color: #fff;
            padding: 18px 32px;
            position: relative;
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #8B6914, #C9A84C, #F0D07A, #C9A84C, #8B6914);
        }
        .header-inner {
            width: 100%;
        }
        .header-inner td { vertical-align: middle; }
        .logo-box {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #8B6914, #C9A84C, #F0D07A);
            border-radius: 7px;
            display: inline-block;
            line-height: 36px;
            text-align: center;
            font-size: 18px;
        }
        .brand-name {
            font-size: 15pt;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.03em;
            vertical-align: middle;
            margin-left: 10px;
        }
        .brand-sub {
            font-size: 7pt;
            color: #C9A84C;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-left: 10px;
        }
        .header-right {
            text-align: right;
        }
        .doc-title {
            font-size: 12pt;
            font-weight: 700;
            color: #C9A84C;
            letter-spacing: 0.05em;
        }
        .doc-meta {
            font-size: 7pt;
            color: #888;
            margin-top: 3px;
        }

        /* ── Résumé filtres ── */
        .summary {
            background: #f8f6f0;
            border-left: 3px solid #C9A84C;
            margin: 16px 32px 0;
            padding: 8px 14px;
            font-size: 8pt;
            color: #555;
        }
        .summary strong { color: #1a1a1a; }

        /* ── Stats ── */
        .stats-row {
            margin: 14px 32px;
        }
        .stats-row table { width: 100%; border-collapse: collapse; }
        .stat-cell {
            text-align: center;
            padding: 10px;
            background: #fafafa;
            border: 1px solid #e8e0cc;
            border-radius: 6px;
            width: 25%;
        }
        .stat-num {
            font-size: 18pt;
            font-weight: 700;
            color: #C9A84C;
            display: block;
        }
        .stat-label {
            font-size: 7pt;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ── Tableau ── */
        .table-wrap { margin: 0 32px 24px; }
        table.data {
            width: 100%;
            border-collapse: collapse;
        }
        table.data thead tr {
            background: #0a0a0a;
            color: #fff;
        }
        table.data thead th {
            padding: 8px 10px;
            text-align: left;
            font-size: 7.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        table.data thead th:first-child { border-radius: 4px 0 0 0; }
        table.data thead th:last-child  { border-radius: 0 4px 0 0; }
        table.data tbody tr:nth-child(even) { background: #faf8f3; }
        table.data tbody tr { border-bottom: 1px solid #ede8d8; }
        table.data tbody td {
            padding: 7px 10px;
            font-size: 8pt;
            color: #222;
            vertical-align: middle;
        }
        .num-cell {
            color: #aaa;
            font-size: 7.5pt;
            text-align: center;
            width: 28px;
        }
        .dest-badge {
            display: inline-block;
            background: #fef9ec;
            border: 1px solid #e8d98a;
            color: #7a5f0a;
            font-size: 7pt;
            padding: 1px 6px;
            border-radius: 9999px;
        }
        .fil-badge {
            display: inline-block;
            background: #edfaf8;
            border: 1px solid #82d5cc;
            color: #1a7a71;
            font-size: 7pt;
            padding: 1px 6px;
            border-radius: 9999px;
        }
        .no-data {
            text-align: center;
            padding: 24px;
            color: #aaa;
            font-style: italic;
        }

        /* ── Footer ── */
        .footer {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: #0a0a0a;
            color: #555;
            font-size: 7pt;
            padding: 6px 32px;
            border-top: 2px solid #C9A84C;
        }
        .footer table { width: 100%; }
        .footer td { vertical-align: middle; }
        .footer-right { text-align: right; color: #C9A84C; }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <table class="header-inner">
        <tr>
            <td>
                <span style="font-size:20pt;color:#C9A84C;">✈</span>
                <span class="brand-name">Travel Express</span><br>
                <span class="brand-sub">Rapport de prospection</span>
            </td>
            <td class="header-right">
                <div class="doc-title">EXPORT PROSPECTS</div>
                <div class="doc-meta">Généré le {{ $generatedAt }}</div>
            </td>
        </tr>
    </table>
</div>

<!-- Filtres actifs -->
@if($filters['destination'] || $filters['filiere'])
<div class="summary">
    <strong>Filtres appliqués :</strong>
    @if($filters['destination']) &nbsp;Destination : <strong>{{ $filters['destination'] }}</strong>@endif
    @if($filters['filiere']) &nbsp;&nbsp;Filière : <strong>{{ $filters['filiere'] }}</strong>@endif
</div>
@endif

<!-- Stats rapides -->
<div class="stats-row">
    <table>
        <tr>
            <td class="stat-cell">
                <span class="stat-num">{{ $prospects->count() }}</span>
                <span class="stat-label">Prospects exportés</span>
            </td>
            <td style="width:2%;"></td>
            <td class="stat-cell">
                <span class="stat-num">{{ $prospects->where('email', '!=', null)->count() }}</span>
                <span class="stat-label">Avec email</span>
            </td>
            <td style="width:2%;"></td>
            <td class="stat-cell">
                <span class="stat-num">{{ $prospects->groupBy('destination')->count() }}</span>
                <span class="stat-label">Destinations</span>
            </td>
            <td style="width:2%;"></td>
            <td class="stat-cell">
                <span class="stat-num">{{ $prospects->groupBy('filiere')->count() }}</span>
                <span class="stat-label">Filières</span>
            </td>
        </tr>
    </table>
</div>

<!-- Tableau -->
<div class="table-wrap">
    <table class="data">
        <thead>
            <tr>
                <th class="num-cell">#</th>
                <th>Nom complet</th>
                <th>WhatsApp</th>
                <th>Email</th>
                <th>Destination</th>
                <th>Filière</th>
                <th>Date d'ajout</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prospects as $i => $p)
            <tr>
                <td class="num-cell">{{ $i + 1 }}</td>
                <td><strong>{{ $p->nom_complet }}</strong></td>
                <td>{{ $p->whatsapp }}</td>
                <td style="color:#555;">{{ $p->email ?: '—' }}</td>
                <td><span class="dest-badge">{{ $p->destination }}</span></td>
                <td><span class="fil-badge">{{ $p->filiere }}</span></td>
                <td style="color:#888;font-size:7.5pt;">{{ $p->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="no-data">Aucun prospect à afficher.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Footer fixe -->
<div class="footer">
    <table>
        <tr>
            <td>&copy; {{ date('Y') }} Travel Express — Document confidentiel</td>
            <td class="footer-right">Prospection Terrain &nbsp;|&nbsp; {{ $prospects->count() }} prospect(s)</td>
        </tr>
    </table>
</div>

</body>
</html>
