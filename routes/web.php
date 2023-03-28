<?php

use App\Events\AccessRequestEvent;
use App\Events\CampaignComplete;
use App\Events\NotificationEvent;
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
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\StickyNoteController;
use App\Http\Controllers\SummernoteController;
use App\Http\Controllers\Trash;
use App\Http\Controllers\UserController;
use App\Models\Contact;
use App\Models\EmailTraker;
use App\Models\StickyNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
    Route::get('/', [SubscribeHomeController::class,'home']);
    Route::post('/', [SubscribeHomeController::class,'store']);
});
Route::domain('app.' . env('APP_DOMAIN', 'consultile.com'))->group(function () {
    Route::group(['middleware' => ['auth', 'permission']], function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        Route::get('contacts/export', [ContactController::class, 'export'])->name('contacts.export');
        Route::get('contacts/export-example', [ContactController::class, 'exportExample'])->name('contacts.export.example');
        Route::get('contacts/import', [ContactController::class, 'import'])->name('contacts.import');
        Route::post('contacts/import', [ContactController::class, 'import'])->name('contacts.import.upload');

        Route::resource('contacts/{contact}/note', StickyNoteController::class);
        Route::resource('contacts', ContactController::class);

        Route::get('email/template/preview/{id}', [EmailTemplateController::class, 'preview'])->name('mail-preview');



        Route::post('/send-test-email', [CampaignController::class, 'send_test'])->name('email.send_test');
        Route::resource('campaigns', CampaignController::class);
        Route::delete('campaigns/{campaign}/attachments', [CampaignController::class, 'removeAttachment'])->name('campaigns.removeAttachment');

        Route::get('subscribes/export', [SubscribeHomeController::class,'export']);
        Route::resource('subscribes', SubscribeHomeController::class);

        Route::resource('users', UserController::class);
        Route::resource('email/templates', EmailTemplateController::class);
        Route::resource('editor', SummernoteController::class);


        Route::resource('settings/trash', Trash::class);
        Route::resource('settings/roles', RolesController::class);
        Route::resource('settings/permissions', PermissionsController::class);
        Route::resource('/server', ServerController::class);
        // Ajax
        Route::post('/email-validation-dns', [ContactController::class, 'emailValidation'])->name('email.validation.dns');
        Route::post('/check-duplicate', [ContactController::class, 'isDuplicate'])->name('check.duplicate');
        Route::post('/contacts/search', [ContactController::class, 'search'])->name('contacts.search');
        Route::post('/notifications/{id}/read', [UserController::class, 'read'])->name('notifications.read');
        Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications.index');
        Route::post('upload',[EmailTemplateController::class,'fileUpload'])->name('Upload Files');

        Route::post('companies',[ContactController::class,'companies'])->name('Companies List');
    });
    Route::get('/gallery',[GalleryController::class,'index'])->name('gallery');
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
    Route::get('countries', [ContactController::class, 'countries']);
    Route::post('targeting', [CampaignController::class, 'targeting']);
    Route::post('requestPermission',function(Request $request){
        $data = [
            'event'=>$request->event,
            'to'=> $request->to,
            'ask'=> $request->ask,
            'id' => $request->id,
            'answer'=>''
        ];
        if(event(new AccessRequestEvent($data))){
            return response()->json(true);
        };
        return response()->json(false);

    });
});
Route::get('test2', function () {

    event(new NotificationEvent('dddddddddddd'));
    return 'notification sent';
});

Route::get('/clear-cache', function() {

    $data = [
        'event'=>'$request->event',
        'to'=> '$request->to',
        'ask'=> '$request->ask',
        'id' => '$request->contactId',
        'answer'=>''
    ];
    event(new AccessRequestEvent($data));
    $data[] = Artisan::call('cache:clear');
    $data[] = Artisan::call('route:clear');
    $data[] = Artisan::call('view:clear');
    $data[] = Artisan::call('config:clear');
    $data[] = Artisan::call('event:clear');
    $data[] = Artisan::call('optimize:clear');

    return response("<h1>All Cache Cleared Successfully</h1>");
});
