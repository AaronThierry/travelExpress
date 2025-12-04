<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function stats()
    {
        // Total users
        $totalUsers = User::count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $newUsersLastMonth = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $usersGrowth = $newUsersLastMonth > 0
            ? round((($newUsersThisMonth - $newUsersLastMonth) / $newUsersLastMonth) * 100, 1)
            : 100;

        // Testimonials stats
        $totalTestimonials = Testimonial::count();
        $pendingTestimonials = Testimonial::where('is_approved', false)->count();
        $approvedTestimonials = Testimonial::where('is_approved', true)->count();
        $newTestimonialsThisMonth = Testimonial::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Recent users (last 7 days)
        $recentUsers = User::whereBetween('created_at', [now()->subDays(7), now()])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get(['id', 'name', 'email', 'country', 'created_at']);

        // Recent testimonials
        $recentTestimonials = Testimonial::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($testimonial) {
                return [
                    'id' => $testimonial->id,
                    'content' => substr($testimonial->content, 0, 100) . '...',
                    'rating' => $testimonial->rating,
                    'is_approved' => $testimonial->is_approved,
                    'user_name' => $testimonial->user->name,
                    'created_at' => $testimonial->created_at->format('d M Y H:i'),
                ];
            });

        // Users by country (top 5)
        $usersByCountry = User::select('country', DB::raw('count(*) as total'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Average rating
        $averageRating = Testimonial::where('is_approved', true)
            ->avg('rating');

        return response()->json([
            'success' => true,
            'data' => [
                'users' => [
                    'total' => $totalUsers,
                    'new_this_month' => $newUsersThisMonth,
                    'growth_percentage' => $usersGrowth,
                ],
                'testimonials' => [
                    'total' => $totalTestimonials,
                    'pending' => $pendingTestimonials,
                    'approved' => $approvedTestimonials,
                    'new_this_month' => $newTestimonialsThisMonth,
                    'average_rating' => round($averageRating, 1),
                ],
                'recent_users' => $recentUsers,
                'recent_testimonials' => $recentTestimonials,
                'users_by_country' => $usersByCountry,
            ]
        ], 200);
    }
}
