<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AdminController;

// General landing page and home route
Route::get('/', function () {
    return view('welcome'); // General welcome page
})->name('welcome');

// General home route
Route::get('/home', function () {
    return view('home'); // General home page
})->name('home');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Login Routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);

    // Admin Logout Route
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Authenticated Admin routes
    Route::middleware(['auth:admin'])->group(function () {
        // Admin Home Route (Professors and Classes View)
        Route::get('/home', [AdminController::class, 'home'])->name('home');

        // Managing Professors (CRUD)
        Route::get('/professors', [AdminController::class, 'indexProfessors'])->name('professors.index');
        Route::get('/professors/create', [AdminController::class, 'createProfessor'])->name('professors.create');
        Route::post('/professors', [AdminController::class, 'storeProfessor'])->name('professors.store');
        Route::get('/professors/{professor}/edit', [AdminController::class, 'editProfessor'])->name('professors.edit');
        Route::put('/professors/{professor}', [AdminController::class, 'updateProfessor'])->name('professors.update');
        Route::delete('/professors/{professor}', [AdminController::class, 'destroyProfessor'])->name('professors.destroy');

        // Managing Courses (CRUD)
        Route::get('/courses', [AdminController::class, 'indexCourses'])->name('courses.index');
        Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::get('/courses/{course}/edit', [AdminController::class, 'editCourse'])->name('courses.edit');
        Route::put('/courses/{course}', [AdminController::class, 'updateCourse'])->name('courses.update');
        Route::delete('/courses/{course}', [AdminController::class, 'destroyCourse'])->name('courses.destroy');
    });
});

// Professor routes
Route::prefix('professor')->name('professor.')->group(function () {
    // Registration routes
    Route::get('/register', [ProfessorController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [ProfessorController::class, 'register']);

    // Login routes
    Route::get('/login', [ProfessorController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ProfessorController::class, 'login']);

    // Logout route
    Route::post('/logout', [ProfessorController::class, 'logout'])->name('logout');

    // Authenticated professor routes
    Route::middleware(['auth:professor'])->group(function () {
        // Home route for professor
        Route::get('/home', [ProfessorController::class, 'home'])->name('home');

        // Route to handle adding class details
        Route::post('/add-class', [ProfessorController::class, 'addClass'])->name('addClass');

        // Route to view the Cahier de Texte (Courses for the logged-in professor)
        Route::get('/cahier-de-texte', [ProfessorController::class, 'viewCahier'])->name('cahierDeTexte');
    });
});
