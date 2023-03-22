<?php

use App\Events\CampaignComplete;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Domains\Subscribe\HomeController as SubscribeHomeController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmailTrakerController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\SummernoteController;
use App\Http\Controllers\Trash;
use App\Http\Controllers\UserController;
use App\Models\Contact;
use App\Models\EmailTraker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::domain('subscribe.' . env('APP_DOMAIN', 'consultile.com'))->group(function () {
    Route::resource('/', SubscribeHomeController::class);
});
Route::domain('app.' . env('APP_DOMAIN', 'consultile.com'))->group(function () {
    Route::group(['middleware' => ['auth', 'permission']], function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        Route::get('contacts/export', [ContactController::class, 'export'])->name('contacts.export');
        Route::get('contacts/export-example', [ContactController::class, 'exportExample'])->name('contacts.export.example');
        Route::get('contacts/import', [ContactController::class, 'import'])->name('contacts.import');
        Route::post('contacts/import', [ContactController::class, 'import'])->name('contacts.import.upload');

        Route::resource('contacts', ContactController::class);

        Route::get('email/template/preview/{id}', [EmailTemplateController::class, 'preview'])->name('mail-preview');



        Route::post('/send-test-email', [CampaignController::class, 'send_test'])->name('email.send_test');
        Route::resource('campaigns', CampaignController::class);
        Route::delete('campaigns/{campaign}/attachments', [CampaignController::class, 'removeAttachment'])->name('campaigns.removeAttachment');

        Route::resource('users', UserController::class);
        Route::resource('email/templates', EmailTemplateController::class);
        Route::resource('editor', SummernoteController::class);


        Route::resource('settings/trash', Trash::class);
        Route::resource('settings/roles', RolesController::class);
        Route::resource('settings/permissions', PermissionsController::class);
        // Ajax
        Route::post('/email-validation-dns', [ContactController::class, 'emailValidation'])->name('email.validation.dns');
        Route::post('/check-duplicate', [ContactController::class, 'isDuplicate'])->name('check.duplicate');
        Route::post('/contacts/search', [ContactController::class, 'search'])->name('contacts.search');
        Route::post('/notifications/{id}/read', [UserController::class, 'read'])->name('notifications.read');
        Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications.index');
        Route::resource('/server', ServerController::class);
    });

    // Route::get('/test',  function () {
    //     return view('test');
    // })->name('test');

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [RegisterController::class, 'create']);
        Route::post('/register', [RegisterController::class, 'store']);
        Route::get('/login', [SessionsController::class, 'create'])->name('login');
        Route::post('/session', [SessionsController::class, 'store']);
        Route::get('/login/forgot-password', [ResetController::class, 'create']);
        Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
        Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
        Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    });
    Route::get('/email-preview', function () {
        return view('mail.test');
    })->name('email.preview');
    Route::get('/logout', [SessionsController::class, 'destroy']);
    // Route::get('/login', [SessionsController::class, 'create'])->name('login');

    Route::get('/newsletters/images/{id}.png', [EmailTrakerController::class, 'index']);
    Route::get('/messages/receipt/{id}.png', [EmailTrakerController::class, 'index']);
    Route::get('/report', [CampaignReportController::class, 'index']);
    Route::get('unsubscribe', [ContactController::class, 'unsubscribe']);
    Route::post('unsubscribe', [ContactController::class, 'unsubscribe']);
    Route::get('companies', [ContactController::class, 'companies']);
});
Route::get('test2', function () {

    require __DIR__ . '/../vendor/autoload.php';

    $options = array(
        'cluster' => 'mt1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'e26f3579c24775647413',
        'bd4323c99bf947f7003f',
        '1571838',
        $options
    );

    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);
    return 'notification sent';
});
