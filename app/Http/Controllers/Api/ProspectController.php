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
