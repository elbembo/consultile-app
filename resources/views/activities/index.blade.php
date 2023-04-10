@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12 d-flex ms-auto">
            <a href="/activities/create" class="btn btn-icon bg-gradient-primary">
                <span class="btn-inner--text">Add Linkedin activity</span>
                <span class="btn-inner--icon ms-2"><i class="fa fa-plus"></i></span>
            </a>
        </div>
        <div class="col-lg-6 col-12 d-flex ms-auto">
            <div class="dropleft ms-auto">

                <button class="btn bg-gradient-dark   fixed-plugin-button " type="button">
                    Fillters
                </button>
                {{-- <ul class="dropdown-menu" aria-labelledby="dropdownImport">
                    <li><a class="dropdown-item" href="javascript:;">Yesterday</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Last 7 days</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Last 30 days</a><ul class="dropdown-menu" aria-labelledby="dropdownImport">
                        <li><a class="dropdown-item" href="javascript:;">Yesterday</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Last 7 days</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Last 30 days</a></li>
                    </ul></li>
                </ul> --}}
            </div>
            <input type="button" name="daterange" class=" bg-gradient-dark btn ms-auto text-white">

        </div>
    </div>
    <div class="row">
        @if (!empty($counts))
            @php
                function action_icon($var)
                {
                    switch ($var) {
                        case 'direct-message':
                            return 'fa-envelope';
                            break;

                        case 'groups-messages':
                            return 'fa-users';
                            break;

                        case 'new-invitations':
                            return 'fa-user-plus';
                            break;
                    }
                    # code...
                }
            @endphp
            @foreach ($counts as $item)
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            {{ str_replace('-', ' ', $item->action) }}</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ $item->total }}
                                            <span class="text-success text-sm font-weight-bolder"></span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                        <i class="fa {{ action_icon($item->action) }} text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                    Duplicates
                                </p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $duplicates ?? 0 }}
                                    <span class="text-success text-sm font-weight-bolder"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                <i class="fa  fa-copy text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card h-100 mt-4 mt-md-0">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6>Connections</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                            data-bs-original-title="Data is based from sessions and is 100% accurate">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body px-3 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-40">
                                        Link</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">
                                        Account</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">
                                        Action taken</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">
                                        Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $connection)
                                    <tr>
                                        <td>
                                            <a href="{{ $connection->url }}"
                                                class="btn-link text-sm font-weight-bold mb-0">{{ str_replace('www.linkedin.com/in/', '.../', $connection->url) }}</a>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $connection->account }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $connection->action }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $connection->message }}</p>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 h-100">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Action Taken</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                            data-bs-original-title="See how much traffic do you get from social media">
                            <i class="fas fa-info" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        @foreach ($counts as $item)
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="w-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <a class="btn btn-facebook btn-simple mb-0 p-0" href="javascript:;">
                                            <i class="fa  {{ action_icon($item->action) }}  fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <span
                                            class="me-2 text-sm font-weight-bold text-capitalize ms-2">{{ str_replace('-', ' ', $item->action) }}</span>
                                        <span
                                            class="ms-auto text-sm font-weight-bold">{{ floor(($item->total / count($activities)) * 100) }}%</span>
                                    </div>
                                    <div>
                                        <div class="progress progress-md">
                                            <div class="progress-bar bg-gradient-dark "
                                                style="width: {{ floor(($item->total / count($activities)) * 100) }}%"
                                                role="progressbar"
                                                aria-valuenow="{{ floor(($item->total / count($activities)) * 100) }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>

            @if (!empty($usersTarget))
                @foreach ($usersTarget as $user)
                    <div class="card mt-3">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">{{$user['name']}}</h6>
                                <button type="button"
                                    class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                    data-bs-original-title="See how much traffic do you get from social media">
                                    <i class="fas fa-info" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @foreach ($user['actions'] as $key => $item)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                        <div class="w-100">
                                            <div class="d-flex align-items-center mb-2">
                                                <a class="btn btn-facebook btn-simple mb-0 p-0" href="javascript:;">
                                                    <i class="fa  {{ action_icon($key) }}  fa-lg"
                                                        aria-hidden="true"></i>
                                                </a>
                                                <span
                                                    class="me-2 text-sm font-weight-bold text-capitalize ms-2">{{ str_replace('-', ' ', $key) }}</span><span class="text-xs">{{ $item['target_per_month'] ?? ''  }} per month</span>
                                                <span
                                                    class="ms-auto text-sm font-weight-bold">{{ $item['target_per_days'] > 0 ? floor(($item['total'] / $item['target_per_days'] ) * 100) : 0 }}%</span>
                                            </div>
                                            <div>
                                                {{-- @dump($item['target_per_days']) --}}
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-gradient-dark "
                                                        style="width: {{ $item['target_per_days'] > 0 ? floor(($item['total'] / $item['target_per_days'] ) * 100) : 0 }}%"
                                                        role="progressbar"
                                                        aria-valuenow="{{ $item['target_per_days'] > 0 ? floor(($item['total'] / $item['target_per_days'] ) * 100) : 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="text-xs">{{ $item['total'] ?? ''  }}/{{ $item['target_per_days'] ?? '' }} for {{ $user['days'] > 1 ? $user['days'].' days' : $user['days'].' day' ?? '' }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        @include('components.fixed-plugin')
    </div>
@endsection
@pushOnce('scripts')
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'right'
            }, function(start, end, label) {
                var url = new URL(window.location.href);
                var search_params = url.searchParams;
                search_params.set('start', start.format('YYYY-MM-DD'));
                search_params.set('end', end.format('YYYY-MM-DD'));
                url.search = search_params.toString();
                var new_url = url.toString();
                window.open(new_url, '_self')
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>
@endPushOnce
