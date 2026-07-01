<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    private function rules(): array
    {
        return [
            'nom_complet' => 'required|string|max:255',
            'whatsapp'    => 'required|string|max:30',
            'email'       => 'nullable|email|max:255',
            'destination' => 'required|string|max:255',
            'filiere'     => 'required|string|max:255',
        ];
    }

    private function messages(): array
    {
        return [
            'nom_complet.required' => 'Le nom complet est requis.',
            'whatsapp.required'    => 'Le numéro WhatsApp est requis.',
            'email.email'          => 'L\'adresse email n\'est pas valide.',
            'destination.required' => 'La destination est requise.',
            'filiere.required'     => 'La filière est requise.',
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        $prospect = Prospect::create($validated);

        return response()->json([
            'success'  => true,
            'message'  => 'Prospect enregistré avec succès.',
            'id'       => $prospect->id,
            'prospect' => $this->format($prospect),
        ], 201);
    }

    public function show($id)
    {
        $prospect = Prospect::find($id);
        if (!$prospect) {
            return response()->json(['success' => false, 'message' => 'Prospect introuvable.'], 404);
        }
        return response()->json(['success' => true, 'prospect' => $this->format($prospect)]);
    }

    public function update(Request $request, $id)
    {
        $prospect = Prospect::find($id);
        if (!$prospect) {
            return response()->json(['success' => false, 'message' => 'Prospect introuvable.'], 404);
        }

        $validated = $request->validate($this->rules(), $this->messages());
        $prospect->update($validated);

        return response()->json([
            'success'  => true,
            'message'  => 'Prospect mis à jour.',
            'prospect' => $this->format($prospect->fresh()),
        ]);
    }

    public function adminIndex(Request $request)
    {
        $query = Prospect::query()->orderByDesc('created_at');

        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }
        if ($request->filled('filiere')) {
            $query->where('filiere', $request->filiere);
        }

        $total        = Prospect::count();
        $today        = Prospect::whereDate('created_at', today())->count();
        $this_week    = Prospect::where('created_at', '>=', now()->startOfWeek())->count();

        $prospects = $query->paginate(20);

        return response()->json([
            'success' => true,
            'stats'   => compact('total', 'today', 'this_week'),
            'data'    => [
                'data'         => $prospects->items(),
                'current_page' => $prospects->currentPage(),
                'last_page'    => $prospects->lastPage(),
                'total'        => $prospects->total(),
            ],
        ]);
    }

    public function adminDestroy($id)
    {
        $prospect = Prospect::find($id);
        if (!$prospect) {
            return response()->json(['success' => false, 'message' => 'Prospect introuvable.'], 404);
        }
        $prospect->delete();
        return response()->json(['success' => true, 'message' => 'Prospect supprimé.']);
    }

    public function exportExcel(Request $request)
    {
        $query = Prospect::query()->orderByDesc('created_at');
        if ($request->filled('destination')) $query->where('destination', $request->destination);
        if ($request->filled('filiere'))     $query->where('filiere', $request->filiere);
        $prospects = $query->get();

        $filtresTxt = 'Généré le ' . now()->format('d/m/Y à H:i');
        if ($request->filled('destination')) $filtresTxt .= ' · Destination : ' . $request->destination;
        if ($request->filled('filiere'))     $filtresTxt .= ' · Filière : ' . $request->filiere;

        $e = fn($v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES | ENT_XML1, 'UTF-8');

        $rows = '';
        foreach ($prospects as $i => $p) {
            $bg = $i % 2 === 0 ? 'sEven' : 'sOdd';
            $rows .= "<Row ss:Height=\"18\">"
                . "<Cell ss:StyleID=\"sNum\"><Data ss:Type=\"Number\">" . ($i + 1) . "</Data></Cell>"
                . "<Cell ss:StyleID=\"sBold\"><Data ss:Type=\"String\">{$e($p->nom_complet)}</Data></Cell>"
                . "<Cell ss:StyleID=\"{$bg}\"><Data ss:Type=\"String\">{$e($p->whatsapp)}</Data></Cell>"
                . "<Cell ss:StyleID=\"{$bg}\"><Data ss:Type=\"String\">{$e($p->email)}</Data></Cell>"
                . "<Cell ss:StyleID=\"sDest\"><Data ss:Type=\"String\">{$e($p->destination)}</Data></Cell>"
                . "<Cell ss:StyleID=\"sFil\"><Data ss:Type=\"String\">{$e($p->filiere)}</Data></Cell>"
                . "<Cell ss:StyleID=\"sDate\"><Data ss:Type=\"String\">{$e($p->created_at->format('d/m/Y H:i'))}</Data></Cell>"
                . "</Row>\n";
        }

        $total = $prospects->count();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<?mso-application progid="Excel.Sheet"?>' . "\n"
            . '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"'
            . ' xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"'
            . ' xmlns:x="urn:schemas-microsoft-com:office:excel">' . "\n"

            // ── Styles ──────────────────────────────────────────────────
            . '<Styles>'

            . '<Style ss:ID="sTitle">'
            . '<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>'
            . '<Font ss:Bold="1" ss:Size="14" ss:Color="#FFFFFF"/>'
            . '<Interior ss:Color="#0A0A0A" ss:Pattern="Solid"/>'
            . '</Style>'

            . '<Style ss:ID="sSub">'
            . '<Alignment ss:Horizontal="Center"/>'
            . '<Font ss:Italic="1" ss:Size="9" ss:Color="#C9A84C"/>'
            . '<Interior ss:Color="#1C1C1C" ss:Pattern="Solid"/>'
            . '</Style>'

            . '<Style ss:ID="sGold">'
            . '<Interior ss:Color="#C9A84C" ss:Pattern="Solid"/>'
            . '</Style>'

            . '<Style ss:ID="sHeader">'
            . '<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>'
            . '<Font ss:Bold="1" ss:Size="10" ss:Color="#0A0A0A"/>'
            . '<Interior ss:Color="#C9A84C" ss:Pattern="Solid"/>'
            . '<Borders>'
            . '<Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#8B6914"/>'
            . '<Border ss:Position="Top"    ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#8B6914"/>'
            . '<Border ss:Position="Left"   ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#8B6914"/>'
            . '<Border ss:Position="Right"  ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#8B6914"/>'
            . '</Borders>'
            . '</Style>'

            . '<Style ss:ID="sEven">'
            . '<Alignment ss:Vertical="Center"/>'
            . '<Font ss:Size="9"/>'
            . '<Interior ss:Color="#FAFAFA" ss:Pattern="Solid"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E8E0CC"/></Borders>'
            . '</Style>'

            . '<Style ss:ID="sOdd">'
            . '<Alignment ss:Vertical="Center"/>'
            . '<Font ss:Size="9"/>'
            . '<Interior ss:Color="#FFFFFF" ss:Pattern="Solid"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E8E0CC"/></Borders>'
            . '</Style>'

            . '<Style ss:ID="sBold">'
            . '<Alignment ss:Vertical="Center"/>'
            . '<Font ss:Bold="1" ss:Size="9"/>'
            . '<Interior ss:Color="#FAFAFA" ss:Pattern="Solid"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E8E0CC"/></Borders>'
            . '</Style>'

            . '<Style ss:ID="sNum">'
            . '<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>'
            . '<Font ss:Size="9" ss:Color="#AAAAAA"/>'
            . '<Interior ss:Color="#FAFAFA" ss:Pattern="Solid"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E8E0CC"/></Borders>'
            . '</Style>'

            . '<Style ss:ID="sDest">'
            . '<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>'
            . '<Font ss:Size="9" ss:Color="#7A5F0A" ss:Bold="1"/>'
            . '<Interior ss:Color="#FEF9EC" ss:Pattern="Solid"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E8D98A"/></Borders>'
            . '</Style>'

            . '<Style ss:ID="sFil">'
            . '<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>'
            . '<Font ss:Size="9" ss:Color="#1A7A71" ss:Bold="1"/>'
            . '<Interior ss:Color="#EDFAF8" ss:Pattern="Solid"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#82D5CC"/></Borders>'
            . '</Style>'

            . '<Style ss:ID="sDate">'
            . '<Alignment ss:Vertical="Center"/>'
            . '<Font ss:Size="9" ss:Color="#888888"/>'
            . '<Interior ss:Color="#FAFAFA" ss:Pattern="Solid"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E8E0CC"/></Borders>'
            . '</Style>'

            . '<Style ss:ID="sTotal">'
            . '<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>'
            . '<Font ss:Bold="1" ss:Size="9" ss:Color="#0A0A0A"/>'
            . '<Interior ss:Color="#F0D07A" ss:Pattern="Solid"/>'
            . '</Style>'

            . '</Styles>' . "\n"

            // ── Feuille ─────────────────────────────────────────────────
            . '<Worksheet ss:Name="Prospects">'
            . '<Table ss:DefaultRowHeight="15">'

            // Largeurs colonnes
            . '<Column ss:Width="30"/>'   // #
            . '<Column ss:Width="160"/>'  // Nom
            . '<Column ss:Width="110"/>'  // WhatsApp
            . '<Column ss:Width="160"/>'  // Email
            . '<Column ss:Width="90"/>'   // Destination
            . '<Column ss:Width="130"/>'  // Filière
            . '<Column ss:Width="95"/>'   // Date

            // Ligne 1 — Titre
            . '<Row ss:Height="28"><Cell ss:MergeAcross="6" ss:StyleID="sTitle">'
            . '<Data ss:Type="String">TRAVEL EXPRESS — Rapport de prospection terrain</Data>'
            . '</Cell></Row>'

            // Ligne 2 — Sous-titre
            . '<Row ss:Height="18"><Cell ss:MergeAcross="6" ss:StyleID="sSub">'
            . '<Data ss:Type="String">' . $e($filtresTxt) . '</Data>'
            . '</Cell></Row>'

            // Ligne 3 — Bande dorée
            . '<Row ss:Height="4"><Cell ss:MergeAcross="6" ss:StyleID="sGold"><Data ss:Type="String"></Data></Cell></Row>'

            // Ligne 4 — En-têtes
            . '<Row ss:Height="20">'
            . '<Cell ss:StyleID="sHeader"><Data ss:Type="String">#</Data></Cell>'
            . '<Cell ss:StyleID="sHeader"><Data ss:Type="String">Nom complet</Data></Cell>'
            . '<Cell ss:StyleID="sHeader"><Data ss:Type="String">WhatsApp</Data></Cell>'
            . '<Cell ss:StyleID="sHeader"><Data ss:Type="String">Email</Data></Cell>'
            . '<Cell ss:StyleID="sHeader"><Data ss:Type="String">Destination</Data></Cell>'
            . '<Cell ss:StyleID="sHeader"><Data ss:Type="String">Filière</Data></Cell>'
            . '<Cell ss:StyleID="sHeader"><Data ss:Type="String">Date d\'ajout</Data></Cell>'
            . '</Row>'

            // Données
            . $rows

            // Ligne total
            . '<Row ss:Height="20">'
            . '<Cell ss:MergeAcross="5" ss:StyleID="sTotal"><Data ss:Type="String">TOTAL</Data></Cell>'
            . '<Cell ss:StyleID="sTotal"><Data ss:Type="String">' . $total . ' prospect(s)</Data></Cell>'
            . '</Row>'

            . '</Table>'

            // Figer les 4 premières lignes (en-têtes)
            . '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">'
            . '<SplitHorizontal>4</SplitHorizontal>'
            . '<TopRowBottomPane>4</TopRowBottomPane>'
            . '<ActivePane>2</ActivePane>'
            . '</WorksheetOptions>'

            . '</Worksheet>'
            . '</Workbook>';

        $filename = 'prospects_' . now()->format('Ymd_His') . '.xls';

        return response($xml, 200, [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control'       => 'max-age=0',
            'Pragma'              => 'public',
        ]);
    }

    public function exportPdf(Request $request)
    {
        $query = Prospect::query()->orderByDesc('created_at');

        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }
        if ($request->filled('filiere')) {
            $query->where('filiere', $request->filiere);
        }

        $prospects    = $query->get();
        $generatedAt  = now()->format('d/m/Y à H:i');
        $filters      = [
            'destination' => $request->destination ?: null,
            'filiere'     => $request->filiere ?: null,
        ];

        $pdf = Pdf::loadView('pdf.prospects', compact('prospects', 'generatedAt', 'filters'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'defaultFont'          => 'sans-serif',
                'dpi'                  => 120,
            ]);

        $filename = 'prospects_' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }

    private function format(Prospect $p): array
    {
        return [
            'id'          => $p->id,
            'nom_complet' => $p->nom_complet,
            'whatsapp'    => $p->whatsapp,
            'email'       => $p->email,
            'destination' => $p->destination,
            'filiere'     => $p->filiere,
            'whatsapp_link' => $p->getWhatsappLink(),
            'created_at'  => $p->created_at->format('d/m/Y H:i'),
        ];
    }
}
