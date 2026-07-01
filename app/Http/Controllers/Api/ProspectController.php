<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

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

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Prospects');

        // ── Ligne 1 : titre Travel Express ──────────────────────────────
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'TRAVEL EXPRESS — Rapport de prospection terrain');
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0A0A0A']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(28);

        // ── Ligne 2 : sous-titre date + filtres ─────────────────────────
        $sheet->mergeCells('A2:G2');
        $filtresTxt = 'Généré le ' . now()->format('d/m/Y à H:i');
        if ($request->filled('destination')) $filtresTxt .= ' · Destination : ' . $request->destination;
        if ($request->filled('filiere'))     $filtresTxt .= ' · Filière : ' . $request->filiere;
        $sheet->setCellValue('A2', $filtresTxt);
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['italic' => true, 'size' => 9, 'color' => ['rgb' => 'C9A84C']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '141414']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(18);

        // ── Ligne 3 : ligne dorée de séparation ─────────────────────────
        $sheet->mergeCells('A3:G3');
        $sheet->getStyle('A3')->applyFromArray([
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'C9A84C']],
        ]);
        $sheet->getRowDimension(3)->setRowHeight(3);

        // ── Ligne 4 : en-têtes colonnes ─────────────────────────────────
        $headers = ['#', 'Nom complet', 'WhatsApp', 'Email', 'Destination', 'Filière', "Date d'ajout"];
        foreach ($headers as $col => $label) {
            $cell = chr(65 + $col) . '4';
            $sheet->setCellValue($cell, $label);
        }
        $sheet->getStyle('A4:G4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => '0A0A0A']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'C9A84C']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '8B6914']]],
        ]);
        $sheet->getRowDimension(4)->setRowHeight(20);

        // ── Lignes données ───────────────────────────────────────────────
        foreach ($prospects as $i => $p) {
            $row   = $i + 5;
            $isEven = ($i % 2 === 0);
            $bgColor = $isEven ? 'FAFAFA' : 'FFFFFF';

            $sheet->setCellValue("A{$row}", $i + 1);
            $sheet->setCellValue("B{$row}", $p->nom_complet);
            $sheet->setCellValue("C{$row}", $p->whatsapp);
            $sheet->setCellValue("D{$row}", $p->email ?? '');
            $sheet->setCellValue("E{$row}", $p->destination);
            $sheet->setCellValue("F{$row}", $p->filiere);
            $sheet->setCellValue("G{$row}", $p->created_at->format('d/m/Y H:i'));

            $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bgColor]],
                'font'      => ['size' => 9],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E8E0CC']]],
            ]);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("B{$row}")->getFont()->setBold(true);
            $sheet->getStyle("G{$row}")->getFont()->setColor((new \PhpOffice\PhpSpreadsheet\Style\Color('FF888888')));
            $sheet->getRowDimension($row)->setRowHeight(18);
        }

        // ── Ligne finale : total ─────────────────────────────────────────
        $lastRow = $prospects->count() + 5;
        $sheet->mergeCells("A{$lastRow}:F{$lastRow}");
        $sheet->setCellValue("A{$lastRow}", 'TOTAL');
        $sheet->setCellValue("G{$lastRow}", $prospects->count() . ' prospect(s)');
        $sheet->getStyle("A{$lastRow}:G{$lastRow}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '0A0A0A']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F0D07A']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // ── Largeurs colonnes ────────────────────────────────────────────
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(28);
        $sheet->getColumnDimension('C')->setWidth(18);
        $sheet->getColumnDimension('D')->setWidth(28);
        $sheet->getColumnDimension('E')->setWidth(16);
        $sheet->getColumnDimension('F')->setWidth(22);
        $sheet->getColumnDimension('G')->setWidth(16);

        // ── Figer la ligne d'en-tête ─────────────────────────────────────
        $sheet->freezePane('A5');

        // ── Propriétés du document ───────────────────────────────────────
        $spreadsheet->getProperties()
            ->setCreator('Travel Express')
            ->setTitle('Prospects Terrain')
            ->setDescription('Export généré le ' . now()->format('d/m/Y'));

        $filename = 'prospects_' . now()->format('Ymd_His') . '.xlsx';
        $writer   = new Xlsx($spreadsheet);

        $tmpFile = tempnam(sys_get_temp_dir(), 'te_xlsx_');
        $writer->save($tmpFile);

        return response()->download($tmpFile, $filename, [
            'Content-Type'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ])->deleteFileAfterSend(true);
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
