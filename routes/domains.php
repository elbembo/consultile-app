<?php 
use Illuminate\Support\Facades\Route;
Route::domain('subscribe.consultile.com')->group(function () {
    Route::get('/', function ($account, $id) {
        //
        return view('domains.subscribe.index');
    });
});
 ?>