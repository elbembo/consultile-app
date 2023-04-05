@php
    Session::flush();
    Auth::logout();
    return redirect()->route('login');
@endphp
@extends('layouts.user_type.auth')

@section('content')
    <div class="row mx-3 row text-center">
        <h1 class="p-5" style="font-size: 10rem;">419</h1>
        <p style="font-size: 2rem;">Session expire</p>
    </div>
@endsection
