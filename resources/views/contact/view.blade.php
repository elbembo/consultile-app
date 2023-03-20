@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Contact Information</h6>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ url('contact/' . $contact->id) }}">
                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" aria-hidden="true"
                                    data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i><span
                                    class="sr-only">Edit Profile</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="form-check form-switch ps-0">
                        <input data-id="{{ $contact->id }}" class="form-check-input green ms-auto" type="checkbox"
                            id="profileSubscribeCheck" {{ $contact->subscribe == 1 ? 'checked' : '' }}>
                        <label class="form-check-label text-body ms-3 text-truncate  mb-0"
                            for="flexSwitchCheckDefault">Subscribe</label>
                    </div>
                    <hr class="horizontal gray-light my-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong>
                            {{ $contact->title }}&nbsp;{{ $contact->first_name }}&nbsp;{{ $contact->last_name }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                            {{ secret($contact->personal_phone) }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Work
                                phone</strong>{{ secret($contact->work_phone) }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                class="text-dark">Email:</strong>{{ secret($contact->email) }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Job Title:</strong>
                            {{ $contact->job_title }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Company:</strong>
                            {{ $contact->company }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Source:</strong>
                            {{ $contact->source }}</li>

                        <li class="list-group-item border-0 ps-0 pb-0">
                            <strong class="text-dark text-sm">Social:</strong> &nbsp;
                            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                <i class="fab fa-facebook fa-lg" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                <i class="fab fa-twitter fa-lg" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                <i class="fab fa-instagram fa-lg" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Contact Information</h6>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ url('contact/' . $contact->id) }}">
                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" aria-hidden="true"
                                    data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i><span
                                    class="sr-only">Edit Profile</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">

                    <hr class="horizontal gray-light my-4">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong>
                            {{ $contact->title }}&nbsp;{{ $contact->first_name }}&nbsp;{{ $contact->last_name }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                            {{ $contact->personal_phone }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Work
                                phone</strong>{{ $contact->work_phone }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                class="text-dark">Email:</strong>{{ $contact->email }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Job Title:</strong>
                            {{ $contact->job_title }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Company:</strong>
                            {{ $contact->company }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Source:</strong>
                            {{ $contact->source }}</li>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <strong class="text-dark text-sm">Social:</strong> &nbsp;
                            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                <i class="fab fa-facebook fa-lg" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                <i class="fab fa-twitter fa-lg" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                <i class="fab fa-instagram fa-lg" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
