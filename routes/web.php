<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FunfactController;
use App\Http\Controllers\FunfactFeedbackController;
use App\Http\Controllers\IdeologyController;
use App\Http\Controllers\PaintingRatingController;
use App\Http\Controllers\AdminPaintingController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'))->name('home');

Route::get('/mentor', fn() => view('mentor'))->name('mentor');
Route::get('/group', fn() => view('group'))->name('group');
// List page: use controller so we can load per-topic data files and pass items to the view
Route::get('/funfact', [FunfactController::class, 'index'])->name('funfact.index');
// Per-topic listing (shows only items within a topic file, e.g., Politik.php)
Route::get('/funfact/category/{topic}', [FunfactController::class, 'category'])->name('funfact.category');
Route::get('/documentation', fn() => view('documentation'))->name('documentation');

// Rating endpoints for public submit (AJAX)
Route::post('/lukisan/{slug}/rate', [PaintingRatingController::class, 'store'])->name('lukisan.rate');
Route::get('/lukisan/{slug}/rating', [PaintingRatingController::class, 'stats'])->name('lukisan.rating');

/*
|--------------------------------------------------------------------------
| Ideology Routes (BARU & SUDAH TERPASANG)
|--------------------------------------------------------------------------
*/
Route::get('/ideologi', [IdeologyController::class, 'index'])->name('ideologi.index');
Route::get('/ideologi/{slug}', [IdeologyController::class, 'show'])->name('ideologi.show');
Route::post('/ideologi/{slug}/feedback', [FunfactFeedbackController::class, 'store'])->name('ideologi.feedback.store');

/*
|--------------------------------------------------------------------------
| Funfact Detail & Feedback
|--------------------------------------------------------------------------
*/
Route::get('/funfact/{slug}', [FunfactController::class, 'show'])->name('funfact.show');
Route::post('/funfact/{slug}/feedback', [FunfactFeedbackController::class, 'store'])->name('funfact.feedback.store');

/*
|--------------------------------------------------------------------------
| Articles by continent
|--------------------------------------------------------------------------
*/
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{continent}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{continent}/history', [ArticleController::class, 'history'])->name('articles.history');

/*
|--------------------------------------------------------------------------
| Survey
|--------------------------------------------------------------------------
*/
Route::get('/survey', [SurveyController::class, 'create'])->name('survey.create');
Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');

/*
|--------------------------------------------------------------------------
| Students (CMS CRUD, Protected)
|--------------------------------------------------------------------------
*/
Route::resource('students', StudentController::class)->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn() => view('dashboard'))->middleware('auth')->name('dashboard');

// Admin paintings list (ratings + comments) — protected
Route::middleware('auth')->prefix('admin')->group(function() {
	Route::get('/', fn() => redirect('/admin/lukisan'));
	Route::get('/lukisan', [AdminPaintingController::class, 'index'])->name('admin.paintings.index');
	Route::get('/lukisan/create', [AdminPaintingController::class, 'create'])->name('admin.paintings.create');
	Route::post('/lukisan', [AdminPaintingController::class, 'store'])->name('admin.paintings.store');
	Route::get('/lukisan/{continent}/{slug}/edit', [AdminPaintingController::class, 'edit'])->name('admin.paintings.edit');
	Route::put('/lukisan/{continent}/{slug}', [AdminPaintingController::class, 'update'])->name('admin.paintings.update');
	Route::delete('/lukisan/{continent}/{slug}', [AdminPaintingController::class, 'destroy'])->name('admin.paintings.destroy');

	// Admin survey listing
	Route::get('/surveys', [App\Http\Controllers\AdminSurveyController::class, 'index'])->name('admin.surveys.index');
	Route::delete('/surveys/{id}', [App\Http\Controllers\AdminSurveyController::class, 'destroy'])->name('admin.surveys.destroy');

	// Users (dummy)
	Route::get('/users', fn() => view('admin.users.index'))->name('admin.users.index');
	// Comments (dummy)
	Route::get('/comments', fn() => view('admin.comments.index'))->name('admin.comments.index');
	// Settings (dummy)
	Route::get('/settings', fn() => view('admin.settings.index'))->name('admin.settings.index');
});

/*
|--------------------------------------------------------------------------
| Debug
|--------------------------------------------------------------------------
*/
Route::get('/welcome-debug', fn() => view('welcome'));
