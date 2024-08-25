<?php

use Inertia\Inertia;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CvformsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VesselsController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\SeafarerController;
use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\SeamanbookController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\MedicalDocumentsController;

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

Route::get('/send/email', function(){
    $name= "Phyu Thet";
    Mail::to('bunnyyoon1@gmail.com')->send(new TestEmail($name));
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::controller(SeafarerController::class)->group(function () {
        Route::get('/applicants', 'applicant_list')->name('applicants.list');
        Route::get('/applicant/{id}', 'show')->name('applicant.detail');
        Route::patch('/applicant', 'changeStatus')->name('applicant.status');
        Route::get('/pdf/applicant/{id}', 'viewpdf')->name('applicant.pdf');
        Route::get('/seafarers', 'seafarer_list')->name('seafarer.list');
        Route::get('/seafarer/{id}', 'showSeafarer')->name('seafarer.detail');
        Route::get('/applicants', 'applicant_list')->name('applicants.list');

    });
    Route::resource('medicalDocuments', MedicalDocumentsController::class)->only('index','store','update');
    Route::resource('bankAccounts', BankAccountsController::class)->only('index','store','update');
    Route::get('/users', [UserController::class, 'user_list'])->name('users.list');
    Route::resource('vessels', VesselsController::class)->only('index', 'store', 'update');
    Route::resource('roles', RolesController::class)->only('index', 'store', 'update');
    Route::resource('jobs', JobsController::class)->only('index', 'store', 'update');
    Route::get('/assign/seafarers/{role_id}', [JobsController::class, 'assignSeafarers'])->name('assign.seafarers');
});

Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/users/home', [UserController::class, 'index'])->name('user.home');
    Route::resource('seafarers', SeafarerController::class)
        ->only('store');
    Route::get('cvforms/{role_id}', [SeafarerController::class, 'index'])->name('cvforms.index');
    Route::get('passport/{seafarer_id}', [PassportController::class, 'index'])->name('passport.index');
    Route::resource('passport', PassportController::class)
        ->only('store');
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
