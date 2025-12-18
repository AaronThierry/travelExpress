<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class EvaluationPdfController extends Controller
{
    /**
     * Generate PDF for an evaluation using DomPDF.
     */
    public function generate($id)
    {
        $evaluation = Evaluation::findOrFail($id);

        // Prepare evaluation data
        $data = [
            'evaluation' => $evaluation,
            'signature' => $this->getSignatureData($evaluation),
            'generatedAt' => now()->format('d/m/Y à H:i'),
        ];

        try {
            $pdf = Pdf::loadView('pdf.evaluation', $data)
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'sans-serif',
                    'dpi' => 150,
                ]);

            $base64Pdf = base64_encode($pdf->output());
            $filename = 'evaluation_' . str_pad($evaluation->id, 4, '0', STR_PAD_LEFT) . '_' . $evaluation->first_name . '_' . $evaluation->last_name . '.pdf';

            return response()->json([
                'success' => true,
                'data' => [
                    'pdf' => $base64Pdf,
                    'filename' => $filename
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la génération du PDF',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get signature as base64 data URL.
     */
    private function getSignatureData(Evaluation $evaluation): ?string
    {
        if (!$evaluation->signature) {
            return null;
        }

        // Already a data URL
        if (str_starts_with($evaluation->signature, 'data:')) {
            return $evaluation->signature;
        }

        // File path - convert to base64
        if (Storage::disk('public')->exists($evaluation->signature)) {
            $content = Storage::disk('public')->get($evaluation->signature);
            $mimeType = Storage::disk('public')->mimeType($evaluation->signature);
            return 'data:' . $mimeType . ';base64,' . base64_encode($content);
        }

        return null;
    }
}
