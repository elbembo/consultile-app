<?php

namespace App\Http\Controllers\Domains\Subscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('domains.subscribe.index');
    }
}
