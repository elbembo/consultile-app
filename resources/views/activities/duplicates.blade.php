@extends('layouts.user_type.auth')

@section('content')

    <div class="row mt-4">
        <div class="col-md-12">
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
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">
                                        Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($duplicates as $connection)
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
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $connection->created_at }}</p>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center">{{ $duplicateActivities->links() }}</div>
                    </div>
                </div>
            </div>
        </div>

        @include('components.fixed-plugin')
    </div>
@endsection
