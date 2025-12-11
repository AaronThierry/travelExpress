<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ContactRequestController;
use App\Http\Controllers\Api\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\ContactRequestController as AdminContactRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Testimonials - public can view
Route::get('/testimonials', [TestimonialController::class, 'index']);

// Contact requests - public can submit
Route::post('/contact-requests', [ContactRequestController::class, 'store']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/verify', [AuthController::class, 'verify']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar']);
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar']);

    // Testimonials - protected routes
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::get('/testimonials/my', [TestimonialController::class, 'myTestimonials']);

    // Admin routes (authentication + admin role required)
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Dashboard
        Route::get('/stats', [DashboardController::class, 'stats']);

        // Users management
        Route::get('/users', [AdminUserController::class, 'index']);
        Route::post('/users/{id}/toggle-admin', [AdminUserController::class, 'toggleAdmin']);
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy']);

        // Testimonials management
        Route::get('/testimonials', [AdminTestimonialController::class, 'index']);
        Route::get('/testimonials/pending', [AdminTestimonialController::class, 'pending']);
        Route::post('/testimonials/{id}/approve', [AdminTestimonialController::class, 'approve']);
        Route::post('/testimonials/{id}/reject', [AdminTestimonialController::class, 'reject']);
        Route::post('/testimonials/{id}/unapprove', [AdminTestimonialController::class, 'unapprove']);

        // Contact requests management
        Route::get('/contact-requests', [AdminContactRequestController::class, 'index']);
        Route::get('/contact-requests/stats', [AdminContactRequestController::class, 'stats']);
        Route::get('/contact-requests/{id}', [AdminContactRequestController::class, 'show']);
        Route::post('/contact-requests/{id}/status', [AdminContactRequestController::class, 'updateStatus']);
        Route::post('/contact-requests/{id}/notes', [AdminContactRequestController::class, 'addNotes']);
        Route::post('/contact-requests/{id}/assign', [AdminContactRequestController::class, 'assign']);
        Route::post('/contact-requests/{id}/contacted', [AdminContactRequestController::class, 'markContacted']);
        Route::delete('/contact-requests/{id}', [AdminContactRequestController::class, 'destroy']);
    });
});
