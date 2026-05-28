<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistreVoyageur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistreVoyageurController extends Controller
{
    // ── KIOSQUE PUBLIC ──────────────────────────────────────────────────────────

    /** GET /api/registre — tous les voyageurs pour le kiosque */
    public function index(): JsonResponse
    {
        $voyageurs = RegistreVoyageur::orderBy('created_at')->get()->map(fn($v) => [
            'id'            => $v->id,
            'nom'           => $v->nom,
            'prenom'        => $v->prenom,
            'depart'        => $v->depart,
            'destination'   => $v->destination,
            'signed'        => !is_null($v->signed_at),
            'signed_at'     => $v->signed_at?->toIso8601String(),
            'signature_svg' => $v->signature_svg,
            'ref'           => 'TE-' . $v->created_at->year . '-' . str_pad($v->id, 4, '0', STR_PAD_LEFT),
            'created_at'    => $v->created_at->toIso8601String(),
        ]);

        return response()->json(['success' => true, 'data' => $voyageurs]);
    }

    /** POST /api/registre/{id}/sign — sauvegarder la signature */
    public function sign(int $id, Request $request): JsonResponse
    {
        $v = RegistreVoyageur::findOrFail($id);

        if ($v->signed_at) {
            return response()->json(['success' => false, 'message' => 'Déjà signé'], 409);
        }

        $validator = Validator::make($request->all(), [
            'signature_svg' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Signature manquante'], 422);
        }

        $v->update([
            'signature_svg' => $request->signature_svg,
            'signed_at'     => now(),
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Signature enregistrée',
            'signed_at' => $v->signed_at->toIso8601String(),
        ]);
    }

    // ── ADMIN ───────────────────────────────────────────────────────────────────

    /** GET /admin/api/registre */
    public function adminIndex(): JsonResponse
    {
        $voyageurs = RegistreVoyageur::orderBy('created_at', 'desc')->get()->map(fn($v) => [
            'id'          => $v->id,
            'nom'         => $v->nom,
            'prenom'      => $v->prenom,
            'depart'      => $v->depart,
            'destination' => $v->destination,
            'signed'      => !is_null($v->signed_at),
            'signed_at'   => $v->signed_at?->format('d/m/Y H:i'),
            'ref'         => 'TE-' . $v->created_at->year . '-' . str_pad($v->id, 4, '0', STR_PAD_LEFT),
            'created_at'  => $v->created_at->format('d/m/Y H:i'),
        ]);

        $total  = $voyageurs->count();
        $signed = $voyageurs->where('signed', true)->count();

        return response()->json([
            'success' => true,
            'stats'   => ['total' => $total, 'signed' => $signed, 'pending' => $total - $signed],
            'data'    => $voyageurs,
        ]);
    }

    /** POST /admin/api/registre */
    public function adminStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nom'         => 'required|string|max:100',
            'prenom'      => 'required|string|max:100',
            'depart'      => 'nullable|string|max:150',
            'destination' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $v = RegistreVoyageur::create([
            'nom'         => $request->nom,
            'prenom'      => $request->prenom,
            'depart'      => $request->depart,
            'destination' => $request->destination,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Voyageur enregistré',
            'data'    => [
                'id'          => $v->id,
                'nom'         => $v->nom,
                'prenom'      => $v->prenom,
                'depart'      => $v->depart,
                'destination' => $v->destination,
                'signed'      => false,
                'ref'         => 'TE-' . $v->created_at->year . '-' . str_pad($v->id, 4, '0', STR_PAD_LEFT),
                'created_at'  => $v->created_at->format('d/m/Y H:i'),
            ],
        ], 201);
    }

    /** DELETE /admin/api/registre/{id} */
    public function adminDestroy(int $id): JsonResponse
    {
        RegistreVoyageur::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => 'Supprimé']);
    }
}
