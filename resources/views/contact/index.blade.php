@extends('layouts.user_type.auth')

@section('content')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-md-4">
                <div class="card-header pb-0">
                    <div class="d-md-flex flex-md-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Contacts - {{ $count ?? ''}} - {{ $countWithEmail ?? '0' }} has email </h5>
                        </div>
                        <div class="d-md-flex flex-md-row justify-content-end">

                            <a href="{{url('contacts/export')}}" class="btn bg-gray-50 btn-sm m-1">{{ __('Export') }}</a>
                            <a href="{{url('contacts/import')}}" class="btn bg-gray-50 btn-sm m-1">{{ __('Import') }}</a>

                            <a href="{{url('contacts/create')}}" class="btn bg-gradient-primary btn-sm m-1">{{ __('New Contact') }}</a>

                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">

                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        job title
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Company
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="result">
                            @include('components.contacts-list')
                            </tbody>
                        </table>

                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center">{{ $contacts->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
