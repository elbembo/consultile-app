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
                            <a href="{{ url('contacts/' . $contact->id . '/edit') }}">
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
                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                <i class="fab fa-linkedin-in fa-lg" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Subscribed campaigns</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        @if (!empty($tracker))
                            @foreach ($tracker as $data)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                    <div class="avatar me-3 " style="background-color: {{ ranlor() }}">

                                        {{ $data['views'] }}
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $data['name'] }}</h6>
                                        <p class="mb-0 text-xs">{{ $data['subject'] }}</p>
                                        <p class="mb-0 text-xs">{{ date('d-m-Y', strtotime($data['created_at'])) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Feedback</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        @if (!empty($feedback))
                            @foreach ($feedback as $key => $data)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $key }}</h6>
                                        <p class="mb-0 text-xs">{{ date('d-m-Y', strtotime($data[0]['created_at'])) }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Notes</h6>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="mx-2"
                            data-bs-toggle="tooltip" title="Add note">
                            <i class="fas fa-sticky-note text-warning"> +</i>
                        </a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add note on</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{$contact->id}}/note" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="note" id="addNote" rows="5"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        @if (!empty($notes))
                            @foreach ($notes as $key => $note)
                                <li class="list-group-item border-0 d-flex align-items-center px-2 mb-2 bg-gradient-faded-light-vertical ">
                                    <div class=" w-100">
                                        <p class="mb-0 text-lg-center">{{ $note->note }}</p>
                                        <p class="mb-0 text-xs">{{ date('d-m-Y', strtotime($note->created_at)) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
