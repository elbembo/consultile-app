<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth')->get('/', function (Request $request) {
    return view('contacts.index');
});
// Route::group(['middleware' => 'auth'], function () {
//     Route::delete('campaign/attachments', [CampaignController::class, 'removeAttachment']);
// });
Route::middleware('auth:sanctum')->delete('campaign/attachments', [CampaignController::class, 'removeAttachment']);
