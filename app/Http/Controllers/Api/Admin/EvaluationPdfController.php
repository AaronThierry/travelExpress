<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class EvaluationPdfController extends Controller
{
    /**
     * Generate PDF for an evaluation using Puppeteer.
     */
    public function generate($id)
    {
        $evaluation = Evaluation::findOrFail($id);

        // Prepare evaluation data for the Node script
        $evaluationData = $evaluation->toArray();

        // If signature exists and is a file path, convert to full URL or base64
        if ($evaluation->signature) {
            if (Storage::disk('public')->exists($evaluation->signature)) {
                $signatureContent = Storage::disk('public')->get($evaluation->signature);
                $mimeType = Storage::disk('public')->mimeType($evaluation->signature);
                $evaluationData['signature'] = 'data:' . $mimeType . ';base64,' . base64_encode($signatureContent);
            } elseif (str_starts_with($evaluation->signature, 'data:')) {
                // Already a data URL
                $evaluationData['signature'] = $evaluation->signature;
            }
        }

        // Convert to JSON for the Node script
        $jsonData = json_encode($evaluationData, JSON_UNESCAPED_UNICODE);

        // Path to the Node script
        $scriptPath = base_path('scripts/generate-evaluation-pdf.js');

        // Run the Node script
        $process = new Process(['node', $scriptPath, $jsonData]);
        $process->setTimeout(60);

        try {
            $process->mustRun();
            $base64Pdf = trim($process->getOutput());

            return response()->json([
                'success' => true,
                'data' => [
                    'pdf' => $base64Pdf,
                    'filename' => 'evaluation_' . str_pad($evaluation->id, 4, '0', STR_PAD_LEFT) . '.pdf'
                ]
            ]);
        } catch (ProcessFailedException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la génération du PDF',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
