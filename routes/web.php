<?php

use App\Mail\SendCV;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VesselsController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\SeafarerController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\EmailController;
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

Route::get('/', [UserController::class, 'welcome'])->name('user.welcome');
Route::get('passport/{seafarer_id}', [PassportController::class, 'index'])->name('passport.index');
Route::get('/seafarer/edit/{id}', [SeafarerController::class, 'show'])->name('seafarer.editPage');
Route::resource('passport', PassportController::class)->only('store');
Route::resource('seafarers', SeafarerController::class)->only('store', 'update', 'show');
Route::resource('certificates', CertificatesController::class)->only('index', 'store', 'show', 'update');
Route::resource('experiences', ExperiencesController::class)->only('index', 'store', 'show', 'update');
Route::post('/seafarer/change/profileImage', [SeafarerController::class, 'changeProfileImage'])->name('seafarer.changeProfile');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('users.index');
    })->name('dashboard');
    Route::resource('users', UserController::class)->only('index', 'store', 'update');
    Route::controller(SeafarerController::class)->group(function () {
        Route::get('/applicants', 'applicantList')->name('applicants.list');
        Route::get('/applicant/{id}', 'detail')->name('applicant.detail');
        Route::patch('/applicant', 'changeStatus')->name('applicant.status');
        Route::get('/pdf/applicant/{id}', 'viewpdf')->name('applicant.pdf');
        Route::get('/seafarers', 'seafarer_list')->name('seafarer.list');
        Route::get('/seafarer/{id}', 'showSeafarer')->name('seafarer.detail');
        Route::get('/form/seafarer', 'seafarerForm')->name('seafarer.form');
        Route::get('/send/email/{id}', 'send_email')->name('assign.email');
        Route::get('/applicant/{filename}', 'serveFile')->name('applicant.serveFile');
        Route::patch('/remark', 'postRemark')->name('seafarer.remark');
        Route::delete('/remove/{id}', 'delete')->name('seafarer.delete');
    });
    Route::controller(PayrollController::class)->group(function () {
        Route::post('/payroll', 'calculate')->name('payroll.calculate');
        Route::get('/status/{id}', 'changeStatus')->name('payroll.pay');
    });

    Route::patch('/certificate/status/{id}', [CertificatesController::class, 'changeStatus'])->name('certificate.status');
    Route::resource('medicalDocuments', MedicalDocumentsController::class)->only('index', 'store', 'show', 'update');
    Route::post('/medicalDocuments/file', [MedicalDocumentsController::class, 'attachNewDocuments'])->name('medicalDocuments.attach');
    Route::resource('bankAccounts', BankAccountsController::class)->only('index', 'store', 'update');
    Route::resource('vessels', VesselsController::class)->only('index', 'store', 'update');
    Route::post('/vessel/image', [VesselsController::class, 'changeVesselImage'])->name('vessel.updateImage');
    Route::get('/vessel/{vessel}/{option?}', [VesselsController::class, 'show'])->name('vessel.show');
    Route::resource('roles', RolesController::class)->only('index', 'store', 'show', 'edit', 'update');
    Route::resource('jobs', JobsController::class)->only('index', 'store', 'update', 'edit');
    Route::get('/assign/seafarers/{applicant_id}/{role_id}', [JobsController::class, 'assignSeafarer'])->name('assign.seafarer');
    Route::resource('leave', LeaveController::class)->only('index');
    Route::get('/email', function () {
        return Inertia::render('Admin/Applicant/SendEmail');
    })->name('send.email');
    Route::post('/send/email', [EmailController::class, 'sendEmail'])->name('send.cv');
    Route::get('/passport/edit/{id}', [PassportController::class, 'edit'])->name('passport.edit');
    Route::resource('passport', PassportController::class)->only('update');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/users/home', [UserController::class, 'index'])->name('user.home');
    Route::controller(SeafarerController::class)->group(function () {
        Route::get('/cvforms', 'index')->name('cvforms.index');
        Route::get('/profile/{id}', 'profile')->name('seafarer.profile');
    });
    Route::resource('leave', LeaveController::class)->only('store');
    Route::post('/seafarer/profile/update', [SeafarerController::class, 'profileEdit'])->name('seafarer.profileUpdate');
});
Route::resource('leave', LeaveController::class)->only('update');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
