<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');

// Web-based login/logout (creates session for admin panel)
Route::post('/web/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('web.login');
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Profile routes
Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');

// Admin routes (protected by auth and admin middleware)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'title' => 'Tableau de bord',
            'subtitle' => 'Vue d\'ensemble de votre activité',
            'showSearch' => false
        ]);
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('admin.users', [
            'title' => 'Utilisateurs',
            'subtitle' => 'Gestion des utilisateurs',
            'showSearch' => true
        ]);
    })->name('admin.users');

    Route::get('/testimonials', function () {
        return view('admin.testimonials', [
            'title' => 'Témoignages',
            'subtitle' => 'Gestion des témoignages',
            'showSearch' => true
        ]);
    })->name('admin.testimonials');

    Route::get('/contact-requests', function () {
        return view('admin.contact-requests', [
            'title' => 'Demandes de contact',
            'subtitle' => 'Gestion des demandes',
            'showSearch' => true
        ]);
    })->name('admin.contact-requests');

    Route::get('/evaluations', function () {
        return view('admin.evaluations', [
            'title' => 'Évaluations',
            'subtitle' => 'Gestion des évaluations',
            'showSearch' => true
        ]);
    })->name('admin.evaluations');

    Route::get('/student-applications', function () {
        return view('admin.student-applications', [
            'title' => 'Dossiers Étudiants',
            'subtitle' => 'Gestion des candidatures',
            'showSearch' => true
        ]);
    })->name('admin.student-applications');
});

// Bourse page
Route::get('/bourse', function () {
    return view('bourse');
})->name('bourse');

// Student Application Upload Routes
Route::get('/student/upload/{token}', [App\Http\Controllers\StudentApplicationController::class, 'showUploadForm'])
    ->name('student.upload.form');

Route::post('/student/upload/{token}', [App\Http\Controllers\StudentApplicationController::class, 'uploadDocument'])
    ->name('student.upload.document');

Route::delete('/student/upload/{token}/document/{documentId}', [App\Http\Controllers\StudentApplicationController::class, 'deleteDocument'])
    ->name('student.delete.document');

Route::post('/student/upload/{token}/submit', [App\Http\Controllers\StudentApplicationController::class, 'submitApplication'])
    ->name('student.submit.application');

Route::get('/document/{documentId}/download', [App\Http\Controllers\StudentApplicationController::class, 'downloadDocument'])
    ->name('document.download');

Route::get('/student-applications/{applicationId}/download-all', [App\Http\Controllers\StudentApplicationController::class, 'downloadAllDocuments'])
    ->name('application.download-all');

Route::get('/document/{documentId}/preview', [App\Http\Controllers\StudentApplicationController::class, 'previewDocument'])
    ->name('document.preview');

// Admin API Routes (web-based, session auth - no token required)
Route::prefix('admin/api')->middleware(['web', 'auth', 'admin'])->group(function () {
    // Dashboard Stats
    Route::get('/stats', [App\Http\Controllers\Api\Admin\DashboardController::class, 'stats'])
        ->name('admin.api.stats');

    // Testimonials
    Route::get('/testimonials', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'index']);
    Route::get('/testimonials/pending', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'pending']);
    Route::post('/testimonials/{id}/approve', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'approve']);
    Route::post('/testimonials/{id}/reject', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'reject']);
    Route::post('/testimonials/{id}/unapprove', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'unapprove']);

    // Users
    Route::get('/users', [App\Http\Controllers\Api\Admin\UserController::class, 'index']);
    Route::post('/users/{id}/toggle-admin', [App\Http\Controllers\Api\Admin\UserController::class, 'toggleAdmin']);
    Route::delete('/users/{id}', [App\Http\Controllers\Api\Admin\UserController::class, 'destroy']);

    // Contact Requests
    Route::get('/contact-requests', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'index']);
    Route::get('/contact-requests/stats', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'stats']);
    Route::get('/contact-requests/{id}', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'show']);
    Route::post('/contact-requests/{id}/status', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'updateStatus']);
    Route::post('/contact-requests/{id}/notes', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'addNotes']);
    Route::post('/contact-requests/{id}/contacted', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'markContacted']);
    Route::delete('/contact-requests/{id}', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'destroy']);

    // Evaluations
    Route::get('/evaluations', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'index']);
    Route::get('/evaluations/stats', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'stats']);
    Route::post('/evaluations/{id}/verify', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'verify']);
    Route::delete('/evaluations/{id}', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'destroy']);

    // Student Applications
    Route::get('/student-applications', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'index']);
    Route::get('/student-applications/stats', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'stats']);
    Route::get('/student-applications/{id}', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'show']);
    Route::post('/student-applications', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'store']);
    Route::put('/student-applications/{id}', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'update']);
    Route::delete('/student-applications/{id}', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'destroy']);
    Route::post('/student-applications/documents/{documentId}/approve', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'approveDocument']);
    Route::post('/student-applications/documents/{documentId}/reject', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'rejectDocument']);
});
