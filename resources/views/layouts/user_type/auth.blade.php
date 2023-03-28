@extends('layouts.app')

@section('auth')


    @if (\Request::is('static-sign-up'))
        @include('layouts.navbars.guest.nav')
        @yield('content')
        @include('layouts.footers.guest.footer')
    @elseif (\Request::is('static-sign-in'))
        @include('layouts.navbars.guest.nav')
        @yield('content')
        @include('layouts.footers.guest.footer')
    @else
        @if (\Request::is('rtl'))
            @include('layouts.navbars.auth.sidebar-rtl')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('layouts.navbars.auth.nav-rtl')
                <div class="px-md-4 py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
        @elseif (\Request::is('profile'))
            @include('layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                @include('layouts.navbars.auth.nav')
                @yield('content')
            </div>
        @elseif (\Request::is('virtual-reality'))
            @include('layouts.navbars.auth.nav')
            <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url("/assets/img/vr-bg.jpg') ;
                background-size: cover;">
                @include('layouts.navbars.auth.sidebar')
                <main class="main-content mt-1 border-radius-lg">
                    @yield('content')
                </main>
            </div>
            @include('layouts.footers.auth.footer')
        @else
            @include('layouts.navbars.auth.sidebar')
            <main
                class="main-content position-relative height-vh-100 h-100  border-radius-lg {{ Request::is('rtl') ? 'overflow-hidden' : '' }}">
                @include('layouts.navbars.auth.nav')
                <div class="px-md-4 py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
        @endif

        @include('components.fixed-plugin')
    @endif

    <div class="modal fade" id="requestPermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="m-md-3 modal-body p-md-4 text-center">
                    <h3> Waiting respone from Admin ...</h3>
                    <button type="button" class="btn btn-primary mt-2">Request Again</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="responePermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="m-md-3 modal-body p-md-4 text-center">
                    <h3> User asking to access</h3>
                    <button type="button" class="btn btn-primary mt-2">Agree</button>
                    <button type="button" class="btn btn-primary mt-2">Disagree</button>
                </div>

            </div>
        </div>
    </div>

@endsection
