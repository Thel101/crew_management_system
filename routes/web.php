<?php

use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\CvformsController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SeamanbookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\VesselsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/applicants', [UserController::class, 'applicant_list'])->name('applicants.list');
    Route::get('/users', [UserController::class, 'user_list'])->name('users.list');
    Route::get('/user/{id}', [UserController::class, 'view'])->name('user.detail');
    Route::patch('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/seafarers', [UserController::class, 'seafarer_list'])->name('seafarer.list');
    Route::resource('vessels', VesselsController::class)->only('index', 'store', 'update');
    Route::resource('roles', RolesController::class)->only('index', 'store', 'update');
    Route::resource('vacancies', VacanciesController::class)->only('index', 'store', 'update');
});

Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/users/home', [UserController::class, 'index'])->name('form');
    Route::resource('cvforms', CvformsController::class)
        ->only('store');
    Route::get('cvforms/{vacancy_id}', [CvformsController::class, 'index'])->name('cvforms.index');
    Route::resource('passport', PassportController::class)
        ->only('index', 'store');
    Route::resource('seaman', SeamanbookController::class)
        ->only('index', 'store');
    Route::resource('certificates', CertificatesController::class)
        ->only('index', 'store');
    Route::resource('experiences', ExperiencesController::class)
        ->only('index', 'store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
