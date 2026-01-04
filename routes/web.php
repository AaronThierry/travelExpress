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

// Profile routes
Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard', [
        'title' => 'Tableau de bord',
        'subtitle' => 'Vue d\'ensemble de votre activité',
        'showSearch' => false
    ]);
})->name('admin.dashboard');

Route::get('/admin/users', function () {
    return view('admin.users', [
        'title' => 'Utilisateurs',
        'subtitle' => 'Gestion des utilisateurs',
        'showSearch' => true
    ]);
})->name('admin.users');

Route::get('/admin/testimonials', function () {
    return view('admin.testimonials', [
        'title' => 'Témoignages',
        'subtitle' => 'Gestion des témoignages',
        'showSearch' => true
    ]);
})->name('admin.testimonials');

Route::get('/admin/contact-requests', function () {
    return view('admin.contact-requests', [
        'title' => 'Demandes de contact',
        'subtitle' => 'Gestion des demandes',
        'showSearch' => true
    ]);
})->name('admin.contact-requests');

Route::get('/admin/evaluations', function () {
    return view('admin.evaluations', [
        'title' => 'Évaluations',
        'subtitle' => 'Gestion des évaluations',
        'showSearch' => true
    ]);
})->name('admin.evaluations');

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

// Admin Student Applications Routes
Route::get('/admin/student-applications', function () {
    return view('admin.student-applications', [
        'title' => 'Dossiers Étudiants',
        'subtitle' => 'Gestion des candidatures',
        'showSearch' => true
    ]);
})->name('admin.student-applications');
