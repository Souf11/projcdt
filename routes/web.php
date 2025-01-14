<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');


Route::get('/home', function () {
    return view('home'); 
})->name('home');


Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);


    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/home', [AdminController::class, 'home'])->name('home');


        Route::get('/professors', [AdminController::class, 'indexProfessors'])->name('professors.index');
        Route::get('/professors/create', [AdminController::class, 'createProfessor'])->name('professors.create');
        Route::post('/professors', [AdminController::class, 'storeProfessor'])->name('professors.store');
        Route::get('/professors/{professor}/edit', [AdminController::class, 'editProfessor'])->name('professors.edit');
        Route::put('/professors/{professor}', [AdminController::class, 'updateProfessor'])->name('professors.update');
        Route::delete('/professors/{professor}', [AdminController::class, 'destroyProfessor'])->name('professors.destroy');


        Route::get('/courses', [AdminController::class, 'indexCourses'])->name('courses.index');
        Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::get('/courses/{course}/edit', [AdminController::class, 'editCourse'])->name('courses.edit');
        Route::put('/courses/{course}', [AdminController::class, 'updateCourse'])->name('courses.update');
        Route::delete('/courses/{course}', [AdminController::class, 'destroyCourse'])->name('courses.destroy');
    });
});


Route::prefix('professor')->name('professor.')->group(function () {

    Route::get('/register', [ProfessorController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [ProfessorController::class, 'register']);


    Route::get('/login', [ProfessorController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ProfessorController::class, 'login']);


    Route::post('/logout', [ProfessorController::class, 'logout'])->name('logout');


    Route::middleware(['auth:professor'])->group(function () {

        Route::get('/home', [ProfessorController::class, 'home'])->name('home');


        Route::post('/add-class', [ProfessorController::class, 'addClass'])->name('addClass');


        Route::get('/cahier-de-texte', [ProfessorController::class, 'viewCahier'])->name('cahierDeTexte');
    });
});
