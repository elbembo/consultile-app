@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        @if(isset($valid))
        {{-- @dd($valid->messages) --}}
        <div class="alert alert-danger mx-4" role="alert">
            <span class="text-white">
                @foreach ($valid as $message)
                    <strong>{{  $message  }}</strong>
                @endforeach
                {{-- @dd($errors) --}}
                
    
    
            </span>
        </div>
        @endif
        <div class="card  mx-4">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Contact Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                
                <form action="{{ isset($contact->id) ? '/contacts'.$contact->id.'/edit' : '/contacts' }}" method="POST" role="form text-left">
                    @csrf
                    @if(isset($contact))
                    @method('PUT')
                    @endif
                    @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 row">
                            <div class="form-group col-md-6">
                                <label for="user-name" class="form-control-label">{{ __('First Name') }}</label>
                                <div class="@error('first_name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ $contact->first_name ?? '' }}" type="text" placeholder="Name" id="user-name" name="first_name">
                                    @error('first_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-name" class="form-control-label">{{ __('Last Name') }}</label>
                                <div class="@error('last_name') border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ $contact->last_name ?? '' }}" type="text" placeholder="Last Name" id="user-name" name="last_name">
                                    @error('last_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="caontact-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="" type="email" placeholder="{{ isset($contact->email) ? secret($contact->email) : '' }}" id="caontact-email" name="email">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 row">
                            <div class="form-group col-md-6 ">
                                <label for="work-phone" class="form-control-label">{{ __('Work Phone') }}</label>
                                <div class="@error('work_phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="{{ isset($contact->work_phone) ? secret($contact->work_phone) : '' }}" id="work-phone" name="work_phone" value="">
                                    @error('work_phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="personal-phone" class="form-control-label">{{ __('Mobile') }}</label>
                                <div class="@error('personal_phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="{{ isset($contact->personal_phone) ? secret($contact->personal_phone) : '' }}" id="personal-phone" name="personal_phone" value="">
                                    @error('personal_phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 row">
                            <div class="form-group col-md-6 ">
                                <label for="Company" class="form-control-label">{{ __('Company') }}</label>
                                <div class="@error('company')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Company" id="Company" name="company" value="{{  $contact->company ?? '' }}">
                                    @error('company')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="job-title" class="form-control-label">{{ __('Job Title') }}</label>
                                <div class="@error('job_title')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Job Title " id="job-title" name="job_title" value="{{  $contact->job_title ?? '' }}">
                                    @error('job_title')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2 ">
                            <div class="form-group">
                                <label for="title" class="form-control-label">{{ __('Country') }}</label>
                                <div class="@error('title')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Country" id="country" name="country" value="{{  $contact->country ?? '' }}">
                                    @error('country')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group">
                                <label for="title" class="form-control-label">{{ __('Title') }}</label>
                                <div class="@error('title')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Dr. " id="title" name="title" value="{{  $contact->title ?? '' }}">
                                    @error('title')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="form-group">
                                <label for="source" class="form-control-label">{{ __('Source') }}</label>
                                <div class="@error('source')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Source" id="source" name="source" value="{{  $contact->source ?? '' }}">
                                    @error('source')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="about">{{ 'About Me' }}</label>
                        <div class="@error('user.about')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me">{{ auth()->user()->about_me }}</textarea>
                        </div>
                    </div> -->
                    <div class="d-flex justify-content-around">
                        <button id="email-validation" type="button" data-id="{{ $contact->id ?? ''}}" class="btn bg-gray-00 btn-md mt-4 mb-4">{{ 'check email validation' }}</button>
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
