<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    /**
     * Get all contact requests with filters
     */
    public function index(Request $request)
    {
        $query = ContactRequest::with('assignedAdmin')
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by destination
        if ($request->has('destination') && $request->destination !== 'all') {
            $query->where('destination', $request->destination);
        }

        // Filter by project type
        if ($request->has('project_type') && $request->project_type !== 'all') {
            $query->where('project_type', $request->project_type);
        }

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate($request->per_page ?? 15);

        return response()->json([
            'success' => true,
            'data' => $requests->items(),
            'meta' => [
                'current_page' => $requests->currentPage(),
                'last_page' => $requests->lastPage(),
                'per_page' => $requests->perPage(),
                'total' => $requests->total(),
            ],
            'filters' => [
                'statuses' => ContactRequest::getStatuses(),
                'destinations' => ContactRequest::getDestinations(),
                'project_types' => ContactRequest::getProjectTypes(),
            ]
        ], 200);
    }

    /**
     * Get a single contact request
     */
    public function show($id)
    {
        $request = ContactRequest::with('assignedAdmin')->find($id);

        if (!$request) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $request,
            'whatsapp_link' => $request->getWhatsappLink(),
        ], 200);
    }

    /**
     * Update contact request status
     */
    public function updateStatus(Request $request, $id)
    {
        $contactRequest = ContactRequest::find($id);

        if (!$contactRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:new,contacted,in_progress,completed,cancelled',
        ]);

        $oldStatus = $contactRequest->status;
        $contactRequest->status = $request->status;

        // Track when first contacted
        if ($oldStatus === 'new' && $request->status === 'contacted') {
            $contactRequest->contacted_at = now();
        }

        // Track last contact
        if (in_array($request->status, ['contacted', 'in_progress'])) {
            $contactRequest->last_contact_at = now();
        }

        $contactRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour',
            'data' => $contactRequest
        ], 200);
    }

    /**
     * Add admin notes
     */
    public function addNotes(Request $request, $id)
    {
        $contactRequest = ContactRequest::find($id);

        if (!$contactRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }

        $request->validate([
            'admin_notes' => 'required|string|max:2000',
        ]);

        $contactRequest->admin_notes = $request->admin_notes;
        $contactRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Notes ajoutées',
            'data' => $contactRequest
        ], 200);
    }

    /**
     * Assign request to admin
     */
    public function assign(Request $request, $id)
    {
        $contactRequest = ContactRequest::find($id);

        if (!$contactRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }

        $contactRequest->assigned_to = $request->user()->id;
        $contactRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Demande assignée',
            'data' => $contactRequest->load('assignedAdmin')
        ], 200);
    }

    /**
     * Mark as contacted via WhatsApp
     */
    public function markContacted($id)
    {
        $contactRequest = ContactRequest::find($id);

        if (!$contactRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }

        if ($contactRequest->status === 'new') {
            $contactRequest->status = ContactRequest::STATUS_CONTACTED;
            $contactRequest->contacted_at = now();
        }

        $contactRequest->last_contact_at = now();
        $contactRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Marqué comme contacté',
            'data' => $contactRequest,
            'whatsapp_link' => $contactRequest->getWhatsappLink(),
        ], 200);
    }

    /**
     * Get statistics for contact requests
     */
    public function stats()
    {
        $total = ContactRequest::count();
        $new = ContactRequest::where('status', 'new')->count();
        $contacted = ContactRequest::where('status', 'contacted')->count();
        $inProgress = ContactRequest::where('status', 'in_progress')->count();
        $completed = ContactRequest::where('status', 'completed')->count();
        $cancelled = ContactRequest::where('status', 'cancelled')->count();

        // This week
        $thisWeek = ContactRequest::whereBetween('created_at', [now()->startOfWeek(), now()])->count();

        // By destination
        $byDestination = ContactRequest::selectRaw('destination, count(*) as total')
            ->groupBy('destination')
            ->get()
            ->pluck('total', 'destination');

        // By project type
        $byProjectType = ContactRequest::selectRaw('project_type, count(*) as total')
            ->groupBy('project_type')
            ->get()
            ->pluck('total', 'project_type');

        // Recent requests
        $recent = ContactRequest::orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($req) {
                return [
                    'id' => $req->id,
                    'name' => $req->name,
                    'destination' => ContactRequest::getDestinations()[$req->destination] ?? $req->destination,
                    'project_type' => ContactRequest::getProjectTypes()[$req->project_type] ?? $req->project_type,
                    'status' => $req->status,
                    'created_at' => $req->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'total' => $total,
                'by_status' => [
                    'new' => $new,
                    'contacted' => $contacted,
                    'in_progress' => $inProgress,
                    'completed' => $completed,
                    'cancelled' => $cancelled,
                ],
                'this_week' => $thisWeek,
                'by_destination' => $byDestination,
                'by_project_type' => $byProjectType,
                'recent' => $recent,
            ]
        ], 200);
    }

    /**
     * Delete a contact request
     */
    public function destroy($id)
    {
        $contactRequest = ContactRequest::find($id);

        if (!$contactRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }

        $contactRequest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Demande supprimée'
        ], 200);
    }
}
