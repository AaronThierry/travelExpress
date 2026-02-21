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
    })->name('admin.dashboard')->middleware('permission:dashboard-view');

    Route::get('/users', function () {
        return view('admin.users', [
            'title' => 'Utilisateurs',
            'subtitle' => 'Gestion des utilisateurs',
            'showSearch' => true
        ]);
    })->name('admin.users')->middleware('permission:users-view');

    Route::get('/testimonials', function () {
        return view('admin.testimonials', [
            'title' => 'Témoignages',
            'subtitle' => 'Gestion des témoignages',
            'showSearch' => true
        ]);
    })->name('admin.testimonials')->middleware('permission:testimonials-view');

    Route::get('/contact-requests', function () {
        return view('admin.contact-requests', [
            'title' => 'Demandes de contact',
            'subtitle' => 'Gestion des demandes',
            'showSearch' => true
        ]);
    })->name('admin.contact-requests')->middleware('permission:contacts-view');

    Route::get('/evaluations', function () {
        return view('admin.evaluations', [
            'title' => 'Évaluations',
            'subtitle' => 'Gestion des évaluations',
            'showSearch' => true
        ]);
    })->name('admin.evaluations')->middleware('permission:evaluations-view');

    Route::get('/student-applications', function () {
        return view('admin.student-applications', [
            'title' => 'Dossiers Étudiants',
            'subtitle' => 'Gestion des candidatures',
            'showSearch' => true
        ]);
    })->name('admin.student-applications')->middleware('permission:applications-view');

    Route::get('/visa-applications', function () {
        return view('admin.visa-applications', [
            'title'      => 'Dossiers Visa',
            'subtitle'   => 'Gestion des dossiers de visa',
            'showSearch' => true
        ]);
    })->name('admin.visa-applications')->middleware('permission:visa-view');

    Route::get('/roles', function () {
        return view('admin.roles', [
            'title' => 'Rôles & Permissions',
            'subtitle' => 'Gestion des accès',
            'showSearch' => true
        ]);
    })->name('admin.roles')->middleware('permission:roles-view');
});

// Mon dossier page
Route::get('/mon-dossier', function () {
    return view('mon-dossier');
})->name('mon-dossier');

// Bourse page
Route::get('/bourse', function () {
    return view('bourse');
})->name('bourse');

// Student Application Upload Routes (legacy - unique_token)
Route::get('/student/upload/{token}', [App\Http\Controllers\StudentApplicationController::class, 'showUploadForm'])
    ->name('student.upload.form');

Route::post('/student/upload/{token}', [App\Http\Controllers\StudentApplicationController::class, 'uploadDocument'])
    ->name('student.upload.document');

Route::delete('/student/upload/{token}/document/{documentId}', [App\Http\Controllers\StudentApplicationController::class, 'deleteDocument'])
    ->name('student.delete.document');

Route::post('/student/upload/{token}/submit', [App\Http\Controllers\StudentApplicationController::class, 'submitApplication'])
    ->name('student.submit.application');

// Student Application Routes (new - access_token)
Route::prefix('dossier')->group(function () {
    Route::get('/{token}', [App\Http\Controllers\StudentApplicationController::class, 'showUploadForm'])
        ->name('dossier.form');

    Route::post('/{token}/info', [App\Http\Controllers\StudentApplicationController::class, 'updateInfo'])
        ->name('dossier.update.info');

    Route::post('/{token}/upload', [App\Http\Controllers\StudentApplicationController::class, 'uploadDocument'])
        ->name('dossier.upload');

    Route::delete('/{token}/document/{documentId}', [App\Http\Controllers\StudentApplicationController::class, 'deleteDocument'])
        ->name('dossier.delete.document');

    Route::post('/{token}/submit', [App\Http\Controllers\StudentApplicationController::class, 'submitApplication'])
        ->name('dossier.submit');

    Route::get('/{token}/status', [App\Http\Controllers\StudentApplicationController::class, 'getStatus'])
        ->name('dossier.status');
});

Route::get('/document/{documentId}/download', [App\Http\Controllers\StudentApplicationController::class, 'downloadDocument'])
    ->name('document.download');

Route::get('/student-applications/{applicationId}/download-all', [App\Http\Controllers\StudentApplicationController::class, 'downloadAllDocuments'])
    ->name('application.download-all');

Route::get('/document/{documentId}/preview', [App\Http\Controllers\StudentApplicationController::class, 'previewDocument'])
    ->name('document.preview');

// ─── Visa Dossier Routes (student-facing, token-based) ─────────────────────
Route::prefix('visa')->group(function () {
    Route::get('/{token}', [App\Http\Controllers\VisaApplicationController::class, 'show'])
        ->name('visa.form');
    Route::post('/{token}/info', [App\Http\Controllers\VisaApplicationController::class, 'updateInfo'])
        ->name('visa.update.info');
    Route::post('/{token}/upload', [App\Http\Controllers\VisaApplicationController::class, 'uploadDocument'])
        ->name('visa.upload');
    Route::delete('/{token}/document/{documentId}', [App\Http\Controllers\VisaApplicationController::class, 'deleteDocument'])
        ->name('visa.delete.document');
    Route::post('/{token}/submit', [App\Http\Controllers\VisaApplicationController::class, 'submit'])
        ->name('visa.submit');
});

Route::get('/visa-document/{documentId}/download', [App\Http\Controllers\VisaApplicationController::class, 'downloadDocument'])
    ->name('visa.document.download');
Route::get('/visa-document/{documentId}/preview', [App\Http\Controllers\VisaApplicationController::class, 'previewDocument'])
    ->name('visa.document.preview');

// Admin API Routes (web-based, session auth - no token required)
Route::prefix('admin/api')->middleware(['web', 'auth', 'admin'])->group(function () {
    // Dashboard Stats
    Route::get('/stats', [App\Http\Controllers\Api\Admin\DashboardController::class, 'stats'])
        ->name('admin.api.stats')->middleware('permission:dashboard-stats');

    // Testimonials
    Route::middleware('permission:testimonials-view')->group(function () {
        Route::get('/testimonials', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'index']);
        Route::get('/testimonials/pending', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'pending']);
    });
    Route::post('/testimonials/{id}/approve', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'approve'])->middleware('permission:testimonials-approve');
    Route::post('/testimonials/{id}/reject', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'reject'])->middleware('permission:testimonials-reject');
    Route::post('/testimonials/{id}/unapprove', [App\Http\Controllers\Api\Admin\TestimonialController::class, 'unapprove'])->middleware('permission:testimonials-unapprove');

    // Users
    Route::get('/users', [App\Http\Controllers\Api\Admin\UserController::class, 'index'])->middleware('permission:users-view');
    Route::post('/users/{id}/toggle-admin', [App\Http\Controllers\Api\Admin\UserController::class, 'toggleAdmin'])->middleware('permission:users-toggle-admin');
    Route::delete('/users/{id}', [App\Http\Controllers\Api\Admin\UserController::class, 'destroy'])->middleware('permission:users-delete');

    // Contact Requests
    Route::middleware('permission:contacts-view')->group(function () {
        Route::get('/contact-requests', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'index']);
        Route::get('/contact-requests/stats', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'stats']);
        Route::get('/contact-requests/{id}', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'show']);
    });
    Route::post('/contact-requests/{id}/status', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'updateStatus'])->middleware('permission:contacts-update-status');
    Route::post('/contact-requests/{id}/notes', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'addNotes'])->middleware('permission:contacts-add-notes');
    Route::post('/contact-requests/{id}/contacted', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'markContacted'])->middleware('permission:contacts-mark-contacted');
    Route::delete('/contact-requests/{id}', [App\Http\Controllers\Api\Admin\ContactRequestController::class, 'destroy'])->middleware('permission:contacts-delete');

    // Evaluations
    Route::middleware('permission:evaluations-view')->group(function () {
        Route::get('/evaluations', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'index']);
        Route::get('/evaluations/stats', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'stats']);
    });
    Route::post('/evaluations/{id}/verify', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'verify'])->middleware('permission:evaluations-verify');
    Route::delete('/evaluations/{id}', [App\Http\Controllers\Api\Admin\EvaluationController::class, 'destroy'])->middleware('permission:evaluations-delete');

    // Student Applications
    Route::middleware('permission:applications-view')->group(function () {
        Route::get('/student-applications', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'index']);
        Route::get('/student-applications/stats', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'stats']);
        Route::get('/student-applications/{id}', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'show']);
    });
    Route::post('/student-applications', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'store'])->middleware('permission:applications-create');
    Route::put('/student-applications/{id}', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'update'])->middleware('permission:applications-edit');
    Route::delete('/student-applications/{id}', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'destroy'])->middleware('permission:applications-delete');
    Route::post('/student-applications/documents/{documentId}/approve', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'approveDocument'])->middleware('permission:applications-approve-docs');
    Route::post('/student-applications/documents/{documentId}/reject', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'rejectDocument'])->middleware('permission:applications-reject-docs');

    // Token management
    Route::post('/student-applications/{id}/generate-token', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'generateToken'])->middleware('permission:applications-generate-links');
    Route::post('/student-applications/{id}/regenerate-token', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'regenerateToken'])->middleware('permission:applications-regenerate-tokens');

    // Complementary dossier routes
    Route::put('/student-applications/{id}/complementary', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'updateComplementary'])->middleware('permission:applications-manage-complementary');
    Route::post('/student-applications/{id}/complementary/upload', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'uploadComplementaryFile'])->middleware('permission:applications-manage-complementary');
    Route::post('/student-applications/{id}/advance-step', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'advanceStep'])->middleware('permission:applications-advance-step');
    Route::post('/student-applications/bulk-update', [App\Http\Controllers\Api\Admin\StudentApplicationAdminController::class, 'bulkUpdateStatus'])->middleware('permission:applications-bulk-update');

    // ─── Visa Applications ──────────────────────────────────────────────
    Route::middleware('permission:visa-view')->group(function () {
        Route::get('/visa-applications', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'index']);
        Route::get('/visa-applications/stats', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'stats']);
        Route::get('/visa-applications/{id}', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'show']);
    });
    Route::post('/visa-applications', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'store'])->middleware('permission:visa-create');
    Route::put('/visa-applications/{id}', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'update'])->middleware('permission:visa-edit');
    Route::delete('/visa-applications/{id}', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'destroy'])->middleware('permission:visa-delete');
    Route::post('/visa-applications/{id}/generate-token', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'generateToken'])->middleware('permission:visa-edit');
    Route::post('/visa-applications/documents/{documentId}/approve', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'approveDocument'])->middleware('permission:visa-approve');
    Route::post('/visa-applications/documents/{documentId}/reject', [App\Http\Controllers\Api\Admin\VisaApplicationAdminController::class, 'rejectDocument'])->middleware('permission:visa-approve');

    // Roles Management
    Route::middleware('permission:roles-view')->group(function () {
        Route::get('/roles', [App\Http\Controllers\Api\Admin\RoleController::class, 'index']);
        Route::get('/roles/permissions', [App\Http\Controllers\Api\Admin\RoleController::class, 'permissions']);
        Route::get('/roles/{id}', [App\Http\Controllers\Api\Admin\RoleController::class, 'show']);
    });
    Route::post('/roles', [App\Http\Controllers\Api\Admin\RoleController::class, 'store'])->middleware('permission:roles-create');
    Route::put('/roles/{id}', [App\Http\Controllers\Api\Admin\RoleController::class, 'update'])->middleware('permission:roles-edit');
    Route::delete('/roles/{id}', [App\Http\Controllers\Api\Admin\RoleController::class, 'destroy'])->middleware('permission:roles-delete');
    Route::post('/roles/assign', [App\Http\Controllers\Api\Admin\RoleController::class, 'assignToUser'])->middleware('permission:users-assign-roles');
    Route::post('/roles/remove', [App\Http\Controllers\Api\Admin\RoleController::class, 'removeFromUser'])->middleware('permission:users-assign-roles');
    Route::put('/users/{userId}/roles', [App\Http\Controllers\Api\Admin\RoleController::class, 'syncUserRoles'])->middleware('permission:users-assign-roles');

    // Permissions Management
    Route::middleware('permission:permissions-view')->group(function () {
        Route::get('/permissions', [App\Http\Controllers\Api\Admin\PermissionController::class, 'index']);
        Route::get('/permissions/grouped', [App\Http\Controllers\Api\Admin\PermissionController::class, 'grouped']);
        Route::get('/permissions/modules', [App\Http\Controllers\Api\Admin\PermissionController::class, 'modules']);
    });
    Route::post('/permissions', [App\Http\Controllers\Api\Admin\PermissionController::class, 'store'])->middleware('permission:permissions-create');
    Route::post('/permissions/bulk', [App\Http\Controllers\Api\Admin\PermissionController::class, 'bulkCreate'])->middleware('permission:permissions-create');
    Route::put('/permissions/{id}', [App\Http\Controllers\Api\Admin\PermissionController::class, 'update'])->middleware('permission:permissions-edit');
    Route::delete('/permissions/{id}', [App\Http\Controllers\Api\Admin\PermissionController::class, 'destroy'])->middleware('permission:permissions-delete');
});
