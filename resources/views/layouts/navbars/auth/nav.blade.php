<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    {{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <!-- <div class="nav-item d-flex align-self-end">
                <a href="https://www.creative-tim.com/product/soft-ui-dashboard-laravel" target="_blank" class="btn btn-primary active mb-0 text-white" role="button" aria-pressed="true">
                    Download
                </a>
            </div> -->
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input id="search" type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ url('/logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer position-relative"><span
                                class="ba badge badge-circle badge-notifcation"> </span></i>
                    </a>

                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        @if (auth()->user() && count(auth()->user()->unreadNotifications) > 0)
                            @foreach (auth()->user()->unreadNotifications as $notifications)
                                <li class="mb-2 notifications" data-id="{{ $notifications->id }}">
                                    <button data-id="{{ $notifications->id }}" class="btn btn-link close-noti p-1">
                                        <i data-id="{{ $notifications->id }}" class="fas fa-times text-black-50"
                                            aria-hidden="true"></i>
                                    </button>
                                    <a class="dropdown-item border-radius-md"
                                        href="{{ $notifications->data['action'] }}">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">

                                                <i class="avatar-sm cursor-pointer {{ $notifications->data['icon'] }} me-3 text-5xl"
                                                    aria-hidden="true"
                                                    style="color:{{ $notifications->data['color'] ?? '' }}"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span
                                                        class="font-weight-bold text-capitalize">{{ $notifications->data['event'] }} </span>{{ $notifications->data['title'] }}
                                                </h6>
                                                <p class="text-xs text-secondary mb-1 text-wrap">
                                                    {{ $notifications->data['body'] }}
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                    <span class="moment">{{ $notifications->data['time'] }}</span>

                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                        <li class="border-top-sm row">
                            <a href="/notifications" class="btn-link pt-2 text-center">Show all notifications</a>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
