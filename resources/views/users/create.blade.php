@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="multisteps-form mb-5">

                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto my-5">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                    <span>User Info</span>
                                </button>
                                <button class="multisteps-form__progress-btn " type="button" title="Employer Info">
                                    <span>Employer Info</span>
                                </button>
                                <button class="multisteps-form__progress-btn " type="button" title="Employer Info">
                                    <span>Employer Documents</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="{{ !empty($user) ? '/users/' . $user->id : '/users' }}"
                                class="multisteps-form__form mb-8" style="height: 408px;" autocomplete="off" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @if (!empty($user))
                                    @method('PUT')
                                @endif
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">User info</h5>
                                    <p class="mb-0 text-sm">User access data</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>First Name</label>
                                                <input class="multisteps-form__input form-control" name="name"
                                                    type="text" value="{{ $user->name ?? '' }}"
                                                    placeholder="eg. Michael">
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Email Address</label>
                                                <input class="multisteps-form__input form-control" name="email"
                                                    type="email" value="{{ $user->email ?? '' }}"
                                                    placeholder="eg. soft@dashboard.com">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Password</label>
                                                <input class="multisteps-form__input form-control" type="password"
                                                    name="password" autocomplete="off" placeholder="******">
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Repeat Password</label>
                                                <input class="multisteps-form__input form-control" type="password"
                                                    name="confirm_password" autocomplete="off" placeholder="******">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Role</label>
                                                <select class="multisteps-form__input form-control" name="role">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ isset($userRole[0]) && $userRole[0] == $role->name ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Employer info</h5>
                                    <p class="mb-0 text-sm">Mandatory informations</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Job title</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    value="{{ $user->emp->title ?? '' }}" name="title"
                                                    placeholder="eg. Sales">
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Sallery</label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    value="{{ $user->emp->sallery ?? '' }}" name="sallery"
                                                    placeholder="eg. 4000">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Hiring date</label>
                                                <input class="multisteps-form__input form-control" type="date"
                                                    value="{{ $user->emp->hiring_date ?? '' }}" name="hiring_date">
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Gender</label>
                                                <select class="multisteps-form__input form-control" name="gender">
                                                    <option>None</option>
                                                    <option value="Male"
                                                        {{ isset($user->emp->gender) && $user->emp->gender == 'Male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="Female"
                                                        {{ isset($user->emp->gender) && $user->emp->gender == 'Female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>User pic</label>
                                                <input class="multisteps-form__input form-control" type="file"
                                                    name="image">
                                            </div>

                                        </div>


                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Employer Docs</h5>
                                    <p class="mb-0 text-sm">upload files and documents of user</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Documents</label>
                                                <input class="form-control" type="file" multiple name="files[]"
                                                    value="{{ old('docs') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if (is_array($user->emp->docs))
                                                    @foreach ($user->emp->docs as $key => $attachment)
                                                        <div class="attachment" data-key="{{ $key }}">
                                                            <a href="/storage/{{ $attachment['path'] ?? ''}}"><span class=" text-truncate">
                                                                <i class="fa fa-file-pdf text-lg mo-sm-1"
                                                                    aria-hidden="true"></i>
                                                                {{ $attachment['name'] ?? ''}}
                                                            </span></a>
                                                            <span class="docs-del"><i
                                                                    data-key="{{ $key }}"
                                                                    data-id="{{ $user->emp->id }}"
                                                                    class="cursor-pointer fa fa-times text-secondary text-lg "
                                                                    aria-hidden="true"></i></span>

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                title="Send">Save</button>
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@pushOnce('scripts')
    <script src="/assets/js/plugins/multistep-form.js"></script>
@endPushOnce
