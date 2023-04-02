@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        @if (session('status'))
            <div class="alert alert-success">
                <span class="text-white">
                <strong>{{ session('status') }}</strong></span>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="/users/create" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New User</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-top">
                                    <div class="dataTable-dropdown"><label>Show <select class="dataTable-selector">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                            </select> entries</label></div>
                                    <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..."
                                            type="text"></div>
                                </div>
                                <div class="dataTable-container">
                                    <table class="table table-flush dataTable-table" id="users-list">
                                        <thead class="thead-light">
                                            <tr>
                                                <th data-sortable="" style="width: 6.41711%;"><a href="#"
                                                        class="dataTable-sorter">ID</a></th>
                                                <th data-sortable="" style="width: 18.2582%;"><a href="#"
                                                        class="dataTable-sorter">PHOTO</a></th>
                                                <th data-sortable="" style="width: 11.3827%;"><a href="#"
                                                        class="dataTable-sorter">NAME</a></th>
                                                <th data-sortable="" style="width: 20.3209%;"><a href="#"
                                                        class="dataTable-sorter">EMAIL</a></th>
                                                <th data-sortable="" style="width: 11.4591%;"><a href="#"
                                                        class="dataTable-sorter">ROLE</a></th>
                                                <th data-sortable="" style="width: 19.7861%;"><a href="#"
                                                        class="dataTable-sorter">CREATION DATE</a></th>
                                                <th data-sortable="" style="width: 12.3759%;"><a href="#"
                                                        class="dataTable-sorter">ACTION</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="text-sm">{{ $user->id }}</td>
                                                    <td class="text-sm">
                                                        <span class="my-2 text-xs avatar avatar-xxl overflow-hidden me-2">
                                                            <img src="/uploads/users/profile/{{ $user->emp->image ?? 'default-' . ($user->emp->gender ?? '') . '.jpg' }}"
                                                                alt="picture">
                                                        </span>
                                                    </td>
                                                    <td class="text-sm">{{ $user->name }}</td>
                                                    <td class="text-sm">{{ $user->email }}</td>
                                                    <td class="text-sm">
                                                        @foreach ($user->roles as $role)
                                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-sm"><span
                                                            class="momentDate">{{ $user->emp->hiring_date ?? '' }}</span>
                                                    </td>
                                                    <td class="text-sm">
                                                        @if($user->approved == 0)
                                                        {!! Form::open(['method' => 'PUT', 'route' => ['users.update', $user->id], 'style' => 'display:inline']) !!}
                                                        <input type="hidden" name="approved" value="1">
                                                        <button type="submit" class="btn btn-slack">
                                                            Approve
                                                        </button>
                                                        {!! Form::close() !!}
                                                        @endif
                                                        <a href="{{ url('users/' . $user->id . '/edit') }}" class="mx-3"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                            <i class="fas fa-user-edit text-secondary"
                                                                aria-hidden="true"></i>
                                                        </a>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                                        <button type="submit" class="btn-clear" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Disabled">
                                                            <i class="fas fa-trash text-secondary" aria-hidden="true"></i>

                                                        </button>
                                                        {!! Form::close() !!}

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="dataTable-bottom">
                                    <div class="dataTable-info">Showing 1 to 3 of 3 entries</div>
                                    <nav class="dataTable-pagination">
                                        <ul class="dataTable-pagination-list"></ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
