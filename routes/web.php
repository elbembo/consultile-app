<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmailTrakerController;
use App\Http\Controllers\SummernoteController;
use App\Models\Contact;
use App\Models\EmailTraker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function () {
        return redirect('campaigns');
    })->name('dashboard');

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');

    // Route::get('contacts/{contact}/edit', function () {
    // 	return view('laravel-examples/contact');
    // })->name('contacts-edit');

    // Route::get('contacts/new', function () {
    // 	return view('laravel-examples/contact');
    // })->name('contacts-new');

    // Route::get('contacts', function () {
    // 	return view('laravel-examples/contacts');
    // })->name('contacts');



    Route::get('contacts/export-example', [ContactController::class, 'exportExample'])->name('contacts.export.example');
    Route::get('contacts/import', [ContactController::class, 'import'])->name('contacts.import');
    Route::post('contacts/import', [ContactController::class, 'import']);
    Route::resource('contacts', ContactController::class);





    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');

    Route::get('tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');
    Route::get('email/template/preview', function () {
        return view('mail.test');
    })->name('mail-preview');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');

    Route::post('/send-test-email', [CampaignController::class, 'send_test'])->name('email.send_test');
    Route::delete('campaigns/attachments', [CampaignController::class, 'removeAttachment']);
    Route::resource('campaigns', CampaignController::class);
    Route::resource('email/templates', EmailTemplateController::class);
    Route::resource('editor', SummernoteController::class);
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});
Route::get('/email-preview', function () {
    return view('mail.test');
})->name('email.preview');
Route::get('/login', function () {
    return view('session/login-session');
})->name('login');

Route::get('/newsletters/images/{id}.png', [EmailTrakerController::class, 'index']);
