<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileSetupController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\HealthAssessmentController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SleepController;



// Routes pour l'authentification
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile/settings', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');



Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
Route::post('/dashboard/settings', [DashboardController::class, 'updateSettings'])->name('dashboard.updateSettings');

Route::middleware(['auth'])->group(function () {
    // Afficher la page de paramètres de santé
    Route::get('/settings', [DashboardController::class, 'showSettings'])->name('settings');

    // Traiter la mise à jour des informations de santé
    Route::post('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');
    Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::delete('/prescriptions/{id}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
});

// web.php
Route::get('/prescriptions/json', [PrescriptionController::class, 'getUserPrescriptions'])->name('prescriptions.json');



Route::middleware(['auth'])->group(function () {
    Route::get('/health-assessment/edit', [HealthAssessmentController::class, 'edit'])->name('health.edit');
    Route::post('/health-assessment', [HealthAssessmentController::class, 'store'])->name('health.store');
    Route::put('/health-assessment', [HealthAssessmentController::class, 'update'])->name('health.update');
});

Route::post('/health/assessment', [App\Http\Controllers\HealthAssessmentController::class, 'store'])->name('health.assessment');
Route::get('/health/assessment', [HealthAssessmentController::class, 'create'])->name('health.assessment.form');
Route::get('/health/assessment/form', [HealthAssessmentController::class, 'create'])->name('health.assessment.form');



Route::get('/diagnosis', [DiagnosisController::class, 'showDiagnosticForm'])->name('diagnosis.form');
Route::post('/diagnosis', [DiagnosisController::class, 'diagnose'])->name('diagnosis.diagnose');




// Routes pour les objectifs personnels
Route::get('/objectifs', [GoalController::class, 'showGoals'])->name('goals.show');
Route::post('/objectifs', [GoalController::class, 'updateGoals'])->name('goals.update');

// Routes pour l'activité physique
Route::get('/activite', [ActivityController::class, 'showActivities'])->name('activities.show');
Route::post('/activite', [ActivityController::class, 'addActivity'])->name('activities.add');

// Routes pour le suivi du sommeil
Route::get('/sommeil', [SleepController::class, 'showSleep'])->name('sleep.show');
Route::post('/sommeil', [SleepController::class, 'addSleep'])->name('sleep.add');

Route::get('/goals', [GoalController::class, 'showDashboard'])->name('goals.dashboard');
Route::post('/goals/update', [GoalController::class, 'update'])->name('goals.update');

Route::get('/activities', [ActivityController::class, 'showDashboard'])->name('activities.dashboard');
Route::post('/activities/add', [ActivityController::class, 'store'])->name('activities.add');

Route::get('/sleep', [SleepController::class, 'showDashboard'])->name('sleep.dashboard');
Route::post('/sleep/add', [SleepController::class, 'store'])->name('sleep.add');


// Routes pour les objectifs personnels
Route::get('/goals', [GoalController::class, 'showDashboard'])->name('goals.dashboard');
Route::get('/goals/create', [GoalController::class, 'show'])->name('goals.show');
Route::post('/goals/store', [GoalController::class, 'store'])->name('goals.store');

Route::get('/activities', [ActivityController::class, 'showDashboard'])->name('activities.dashboard');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');

Route::get('/sleep', [SleepController::class, 'showDashboard'])->name('sleep.dashboard');
Route::post('/sleep', [SleepController::class, 'store'])->name('sleep.store');
Route::get('/sleep/create', [SleepController::class, 'create'])->name('sleep.create');
// Routes pour les objectifs personnels (Goals)
Route::get('/goals', [GoalController::class, 'showDashboard'])->name('goals.dashboard');
Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create'); // Route vers le formulaire de création
Route::post('/goals', [GoalController::class, 'store'])->name('goals.store'); // Route pour enregistrer un nouvel objectif
Route::get('/goals/{goal}/edit', [GoalController::class, 'edit'])->name('goals.edit'); // Route vers le formulaire d'édition
Route::put('/goals/{goal}', [GoalController::class, 'update'])->name('goals.update'); // Route pour mettre à jour un objectif
Route::delete('/goals/{goal}', [GoalController::class, 'destroy'])->name('goals.destroy'); // Route pour supprimer un objectif

Route::get('/activities', [ActivityController::class, 'showDashboard'])->name('activities.dashboard');
Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

// Routes pour le suivi du sommeil (Sleep)
Route::get('/sleep', [SleepController::class, 'showDashboard'])->name('sleep.dashboard');
Route::get('/sleep/create', [SleepController::class, 'create'])->name('sleep.create');
Route::post('/sleep', [SleepController::class, 'store'])->name('sleep.store');
Route::get('/sleep/{sleep}/edit', [SleepController::class, 'edit'])->name('sleep.edit');
Route::put('/sleep/{sleep}', [SleepController::class, 'update'])->name('sleep.update');
Route::delete('/sleep/{sleep}', [SleepController::class, 'destroy'])->name('sleep.destroy');

Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');

Route::get('/sleep/{sleep}/edit', [SleepController::class, 'edit'])->name('sleep.edit');
Route::put('/sleep/{sleep}', [SleepController::class, 'update'])->name('sleep.update');


Route::middleware(['auth'])->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
