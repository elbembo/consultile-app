<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main" data-color="dark">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <img src="/assets/img/Consultile-01_.png" class="navbar-brand-img h-100" alt="...">
            <span class="ms-3 font-weight-bold">Consultile CRM</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ str_contains(url()->current(), 'contacts') ? 'active' : '' }} "
                    href="{{ url('contacts') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-address-book top-0 text-center text-dark {{ str_contains(url()->current(), 'contacts') ? 'text-white' : 'text-dark' }} "
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contacts</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h5 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Markting</h5>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ str_contains(url()->current(), 'campaigns') ? 'active' : '' }}"
                    href="{{ url('campaigns') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-envelope top-0 text-center text-dark {{ str_contains(url()->current(), 'campaigns') ? 'text-white' : 'text-dark' }} "
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Campaigns</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ str_contains(url()->current(), 'email/templates') ? 'active' : '' }}"
                    href="{{ url('email/templates') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-file-code top-0 text-center text-dark {{ str_contains(url()->current(), 'email/templates') ? 'text-white' : 'text-dark' }} "
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Email Templates</span>
                </a>
            </li>
            @can('activities.*')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#activities"
                        class="nav-link  {{ str_contains(url()->current(), 'activities') ? 'active' : '' }}"
                        aria-controls="activities" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm btn-linkedin shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i
                                class="fab fa-linkedin-in fa-lg  top-0 text-center  {{ str_contains(url()->current(), 'activities') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Linkedin marketing</span>
                    </a>
                    <div class="collapse   {{ str_contains(url()->current(), 'activities') ? 'show' : '' }}"
                        id="activities">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('activities.index') }}">
                                    <span class="sidenav-mini-icon"> O </span>
                                    <span class="sidenav-normal"> Overview </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('activities.create') }}">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal"> Daily Activities </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('#') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Projects list </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('settings/drop-list') }}">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal"> Drop List </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endcan
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Company</h6>
            </li>

            @canany(['projects.index'])
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#projects"
                        class="nav-link  {{ str_contains(url()->current(), 'projects') ? 'active' : '' }}"
                        aria-controls="projects" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i
                                class="fas fa-lg fa-suitcase top-0 text-center  {{ str_contains(url()->current(), 'projects') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Projects</span>
                    </a>
                    <div class="collapse   {{ str_contains(url()->current(), 'projects') ? 'show' : '' }}" id="projects">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('#') }}">
                                    <span class="sidenav-mini-icon"> O </span>
                                    <span class="sidenav-normal"> Overview </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('#') }}">
                                    <span class="sidenav-mini-icon"> O </span>
                                    <span class="sidenav-normal"> Opportunity </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('#') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Projects list </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endcanany
            @can('financial.*')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#financial"
                        class="nav-link  {{ str_contains(url()->current(), 'financial') ? 'active' : '' }}"
                        aria-controls="subscribe" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i style="font-size: 1rem;" class="fa fa-lg fa-dollar top-0 text-center text-dark "
                                aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Financial</span>
                    </a>
                    <div class="collapse   {{ str_contains(url()->current(), 'financial') ? 'show' : '' }}"
                        id="financial">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('#') }}">
                                    <span class="sidenav-mini-icon"> R </span>
                                    <span class="sidenav-normal"> Revenues </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('#') }}">
                                    <span class="sidenav-mini-icon"> E </span>
                                    <span class="sidenav-normal"> Expenses </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endcan
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Forms</h6>
            </li>
            @can('subscribes.*')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#subscribe"
                        class="nav-link  {{ str_contains(url()->current(), 'subscribes') ? 'active' : '' }}"
                        aria-controls="subscribe" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i
                                class="fas  fa-lg fa-pen-alt top-0 text-center  {{ str_contains(url()->current(), 'subscribes') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Subscribe App</span>
                    </a>
                    <div class="collapse   {{ str_contains(url()->current(), 'subscribes') ? 'show' : '' }}"
                        id="subscribe">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('subscribes') }}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Subscriber List </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endcan
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#feedback"
                    class="nav-link  {{ str_contains(url()->current(), 'feedback') ? 'active' : '' }}"
                    aria-controls="subscribe" role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-comment-dots top-0 text-center text-dark "
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Feedback App</span>
                </a>
                <div class="collapse   {{ str_contains(url()->current(), 'feedback') ? 'show' : '' }}"
                    id="feedback">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('#') }}">
                                <span class="sidenav-mini-icon"> F </span>
                                <span class="sidenav-normal"> Feedback list </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('#') }}">
                                <span class="sidenav-mini-icon"> F </span>
                                <span class="sidenav-normal"> Fields </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Managing</h6>
            </li>

            @can('users.index')
                <li class="nav-item">
                    <a href="/users" class="nav-link  {{ str_contains(url()->current(), 'users') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48" viewBox="0 0 48 48">
                                <title>profile</title>
                                <g class="nc-icon-wrapper">
                                    <path class="color-background"
                                        d="M43.25,37.8,30,32V22H18V32l-.125.062L4.754,37.8A4.985,4.985,0,0,0,2,42.009V45a1,1,0,0,0,1,1H45a1,1,0,0,0,1-1V42.009A4.979,4.979,0,0,0,43.25,37.8Z"
                                        fill-rule="evenodd" />
                                    <path class="color-background"
                                        d="M24,28A11.013,11.013,0,0,1,13,17V13a11,11,0,0,1,22,0v4A11.013,11.013,0,0,1,24,28Z" />
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>

                </li>
            @endcan
            @can('settings.*')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#applicationsExamples"
                        class="nav-link  {{ str_contains(url()->current(), 'settings') || str_contains(url()->current(), 'server') ? 'active' : '' }}"
                        aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>settings</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(304.000000, 151.000000)">
                                                <polygon class="color-background" opacity="0.596981957"
                                                    points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                </polygon>
                                                <path class="color-background"
                                                    d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"
                                                    opacity="0.596981957"></path>
                                                <path class="color-background"
                                                    d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                    <div class="collapse   {{ str_contains(url()->current(), 'settings') || str_contains(url()->current(), 'server') ? 'show' : '' }}"
                        id="applicationsExamples">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('settings/trash') }}">
                                    <span class="sidenav-mini-icon"> T </span>
                                    <span class="sidenav-normal"> Trash </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('settings/drop-list') }}">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal"> Drop List </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('settings/permissions') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal"> Permissions </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('settings/roles') }}">
                                    <span class="sidenav-mini-icon"> R </span>
                                    <span class="sidenav-normal"> Roles </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('settings/server') }}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Server </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ url('settings/server/error') }}">
                                    <span class="sidenav-mini-icon"> E </span>
                                    <span class="sidenav-normal"> Error log </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endcan
        </ul>
    </div>

</aside>
