@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <form action="{{(isset($campaign) ?  url('campaigns/'.$campaign->id) : url('campaigns'))}}" method="POST" role="form text-left">
            @if(isset($campaign))
            @method('PATCH')
            @endif

            @csrf
            <div class="card mb-2">
                <div class="card-header">
                    <h6 class="mb-0">{{ __('Campaign Information') }}</h6>
                </div>
                <div class="card-body pt-4 p-3 {{ (isset($campaign) ? 'd-none' : '' ) }}">

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
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="campaign-name" class="form-control-label">{{ __('Campaign Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->name : '' ) }}" type="text" placeholder="Campaign Name"
                                        id="campaign-name" name="name" required>
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email-template"
                                    class="form-control-label">{{ __('Email template') }}</label>
                                <div class="@error('email.template') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="template_id" id="email-template">
                                        <option value="0">Create a new ...</option>

                                        @if(isset($templates))
                                        @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ ((isset($campaign) && $template->id == $campaign->template_id )? 'selected' : '' ) }} >{{ $template->template_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="campaign-piorty" class="form-control-label">{{ __('Priority') }}</label>
                                <div class="@error('email.template') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="campaign_piorty" id="campaign-piorty">
                                        <option value="1" {{ ((isset($campaign) && $campaign->campaign_priority == 1 )? 'selected' : '' ) }} >Normal</option>
                                        <option value="0" {{ ((isset($campaign) && $campaign->campaign_priority == 0)? 'selected' : '' ) }} >High</option>
                                        <option value="2" {{ ((isset($campaign) && $campaign->campaign_priority == 2)? 'selected' : '' ) }} >Low</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Target Audience') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <div class="form-control form-control-tags">
                                        <span>All</span>
                                        <input class="m-0 p-0 border-0 mx-1" placeholder="Contacts Tags..."
                                            style="outline: none;" type="text" id="target-audience">
                                    </div>
                                    <input type="hidden" name="target_audience" value="All">


                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="target-location"
                                    class="form-control-label">{{ __('Target Location') }}</label>
                                <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                    <div class="form-control form-control-tags">
                                        <span>All</span>
                                        <input class="m-0 p-0 border-0 mx-1" placeholder="Countries"
                                            style="outline: none;" type="text" id="target-location">
                                    </div>
                                    <input type="hidden" name="target_location" value="All">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="email-subject" class="form-control-label">{{ __('Email Subject') }}</label>
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->subject : '' ) }}" placeholder="Email Subject" type="text"
                                        id="email-subject" name="subject" required>
                                    @error('subject')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sender-name" class="form-control-label">{{ __('Sender Name') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->sender_name :   $headers['stmp_sender_name'] ?? '' )}}"
                                        type="text" placeholder="Sender Name" id="sender-name" name="sender_name"
                                        required>
                                    @error('sender_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="replay-to" class="form-control-label">{{ __('Replay to (Email)') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->replay_to : $headers['stmp_replay_email'] ?? '') }}"
                                        type="email" placeholder="Replay to (Email)" id="replay-to" name="replay_to"
                                        required>
                                    @error('sender_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="replay-to-name"
                                    class="form-control-label">{{ __('Replay to (Name)') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->replay_to_name :  $headers['stmp_replay_name'] ?? '' )}}"
                                        type="text" placeholder="Replay to (Name)" id="replay-to-name"
                                        name="replay_to_name" required>
                                    @error('sender_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <h4> Email header view</h4>
                        </div>
                        <div class="form-group">
                            <label for="about">{{ 'Description' }}</label>
                            <div class="@error('user.about')border border-danger rounded-3 @enderror">
                                <textarea class="form-control" id="about" rows="3"
                                    placeholder="Say something about yourself" name="about_me">{{ (isset($campaign) ? $campaign->description : '' ) }}</textarea>
                            </div>
                        </div>

                    </div>






                </div>
            </div>
            @if(isset($campaign) && $campaign->template_id == 0 )
            <div class="card mb-2">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Campaign Information') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <h2>create temp</h2>

                    </div>
                </div>
            </div>
            @endif
            <div class="card mb-5">
                <div class="card-body pt-4 p-3">
                    <div class="d-flex justify-content-end">
                        <button type="submit"
                            class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
