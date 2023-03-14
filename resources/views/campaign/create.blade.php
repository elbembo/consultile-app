@extends('layouts.user_type.auth')

@section('content')
<style>
    .zoom-out {
        zoom: 0.3;
        flex: 0 0 auto;
        width: 50%;
    }

    button.clips::before {
        content: '\002B';

        font-size: 1.5rem;
    }

    button.clips.expend::before {
        content: '\2212';

    }
</style>
<div>

    <div class="container-fluid py-4 contact-edit">

        <form action="{{(isset($campaign) ?  url('campaigns/'.$campaign->id) : url('campaigns'))}}" method="POST" role="form text-left">
            @csrf
            @if(isset($campaign))
            @method('PATCH')
            @if($campaign->status == 'canceled')
            <div class="rubber">
                Canceled
            </div>
            @endif
            @endif

            <div class="card mb-2">
                <div class="card-header">
                    <h6 class="mb-0 d-flex justify-content-between">{{ __('Campaign Information') }}
                        <span> <button class="btn m-0 py-1 px-2 text-lg  bg-gradient-faded-danger text-white clips" type="button" onclick="javascript:cardExpend(this,'info-body');"></button></span>
                    </h6>
                </div>
                <div id="info-body" class="card-body pt-4 p-3 {{ (isset($campaign) ? 'd-none' : '' ) }}">

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
                                    <input type="hidden" name="id" value="{{ (isset($campaign) ? $campaign->id : '' ) }}">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->name : '' ) }}" type="text" placeholder="Campaign Name" id="campaign-name" name="name" required>
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email-template" class="form-control-label">{{ __('Email template') }}</label>
                                <div class="@error('email.template') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="template_id" id="email-template">
                                        <option value="0">Create a new ...</option>

                                        @if(isset($templates))
                                        @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ ((isset($campaign) && $template->id == $campaign->template_id )? 'selected' : '' ) }}>{{ $template->template_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="campaign-priority" class="form-control-label">{{ __('Priority') }}</label>
                                <div class="@error('email.template') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="campaign_priority" id="campaign-priority">
                                        <option value="2" {{ ((isset($campaign) && $campaign->campaign_priority == 2 )? 'selected' : '' ) }}>Normal</option>
                                        <option value="1" {{ ((isset($campaign) && $campaign->campaign_priority == 1)? 'selected' : '' ) }}>High</option>
                                        <option value="3" {{ ((isset($campaign) && $campaign->campaign_priority == 3)? 'selected' : '' ) }}>Low</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Target Audience') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <div class="form-control form-control-tags">
                                        <span>All</span>
                                        <input class="m-0 p-0 border-0 mx-1" placeholder="Contacts Tags..." style="outline: none;" type="text" id="target-audience">
                                    </div>
                                    <input type="hidden" name="target_audience" value="All">


                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="target-location" class="form-control-label">{{ __('Target Location') }}</label>
                                <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                    <div class="form-control form-control-tags">
                                        <span>All</span>
                                        <input class="m-0 p-0 border-0 mx-1" placeholder="Countries" style="outline: none;" type="text" id="target-location">
                                    </div>
                                    <input type="hidden" name="target_location" value="All">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="email-subject" class="form-control-label">{{ __('Email Subject') }}</label>
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->subject : '' ) }}" placeholder="Email Subject" type="text" id="email-subject" name="subject" required>
                                    @error('subject')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sender-name" class="form-control-label">{{ __('Sender Name') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->sender_name :   $headers['stmp_sender_name'] ?? '' )}}" type="text" placeholder="Sender Name" id="sender-name" name="sender_name" required>
                                    @error('sender_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="replay-to" class="form-control-label">{{ __('Reply to (Email)') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->replay_to : $headers['stmp_replay_email'] ?? '') }}" type="email" placeholder="Reply to (Email)" id="replay-to" name="replay_to" required>
                                    @error('sender_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="replay-to-name" class="form-control-label">{{ __('Reply to (Name)') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ (isset($campaign) ? $campaign->replay_to_name :  $headers['stmp_replay_name'] ?? '' )}}" type="text" placeholder="Reply to (Name)" id="replay-to-name" name="replay_to_name" required>
                                    @error('sender_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="about">{{ 'Description' }}</label>
                                <div class="@error('user.about')border border-danger rounded-3 @enderror">
                                    <textarea class="form-control" id="about" rows="12" placeholder="Say something about yourself" name="description">{{ (isset($campaign) ? $campaign->description : '' ) }}</textarea>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </div>
            </div>
        </form>
        @if(isset($campaign) && $campaign->template_id == 0 )
        <div class="card mb-2">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Campaign Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="row">
                    <iframe src="/editor?c={{ $campaign->id }}" frameborder="0" height="400"></iframe>

                </div>
            </div>
        </div>
        @endif
        @if(isset($campaign) && $campaign->template_id != 0 )
        <div class="card mb-2">
            <div class="card-header">
                <h6 class="mb-0 d-flex justify-content-between">{{ __('Campaign Information')   }} <small class="text-normal text-muted ">( {{ $template->template_name }} )</small>
                    <span> <button class="btn m-0 py-1 px-2  text-lg bg-gradient-faded-danger text-white clips" type="button" onclick="javascript:tempZoom(this,'temp-view');"></button></span>
                </h6>
            </div>
            <div class="card-body pt-4 p-3">

                <div class="row">
                    <div id="temp-view" class="col-md-12">
                        <!-- <iframe src="/email/templates/{{ $template->id }}" frameborder="0" width="550" height="500"></iframe> -->
                        <iframe src="/editor?{{ isset($campaign->template_id) ? "t=$campaign->template_id" : '' }}" frameborder="0" height="600" width="800"></iframe>
                    </div>
                </div>
                <div class="row">
                    <!-- <div id="temp-view"  class="col-8  {{ (isset($campaign) ? 'zoom-out col-6 ' : '' ) }}"><iframe src="/email/templates/{{ $template->id }}"  frameborder="0" height="500"></iframe></div> -->



                    <div class="col-md-4">
                        <form action="{{(isset($campaign) ?  url('campaigns/'.$campaign->id) : url('campaigns'))}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <fieldset class="form-group">
                                <legend>Attachments</legend>
                                @if(is_array($campaign->details))
                                @foreach($campaign->details as $key => $attachment)
                                <div class="attachment" data-key="{{ $key }}"  >
                                    <span>
                                        <i class="fa fa-file-pdf text-lg mo-sm-1" aria-hidden="true"></i>
                                        {{ $attachment["name"] }}
                                    </span>
                                    <span class="attachment-del"><i data-key="{{ $key }}" data-id="{{$campaign->id}}" class="cursor-pointer fa fa-times text-secondary text-lg " aria-hidden="true"></i></span>

                                </div>
                                @endforeach
                                @endif
                                <input type="hidden" name="id">
                                <input type="hidden" name="action" value="uploads">
                                <input class="form-control" type="file" multiple name="attachmens[]" value="{{old('attachmens')}}">
                                <button class="btn bg-gradient-dark mt-2 mb-0" type="submit">
                                    <i class="fa fa-upload me-sm-1" aria-hidden="true"></i>Upload</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="">
                            <fieldset class="form-group">
                                <legend>Test Email</legend>
                                <div class="form-group">
                                    <label for="send-to" class="form-control-label">{{ __('Email to send a test') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="" type="email" placeholder="test email" id="send-to" name="send_to">
                                    </div>
                                </div>

                                <button type="button" id="send-test" class="btn bg-gradient-secondary mb-0 mt-2"><i class="fa fa-envelope me-sm-1" aria-hidden="true"></i> Send</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="{{(isset($campaign) ?  url('campaigns/'.$campaign->id) : url('campaigns'))}}" method="post">
                            <fieldset class="form-group">
                                <legend>Take Action</legend>
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id">
                                <input type="hidden" name="action" value="update_status">
                                @if($campaign->status == 'draft')
                                <input type="hidden" name="status" value="processing">
                                <button class="btn bg-gradient-success text-lg mt-2" type="submit"><i class="fa fa-play me-sm-1" aria-hidden="true"></i>Run campaign</button>
                                @elseif($campaign->status == 'processing')
                                <input type="hidden" name="status" value="canceled">
                                <button class="btn bg-gradient-danger text-lg mt-2" type="submit"><i class="fa fa-stop me-sm-1" aria-hidden="true"></i>Stop campaign</button>
                                @endif
                            </fieldset>
                        </form>
                    </div>

                </div>
                @endif


                <script>
                    // if (document.querySelector('#send-test'))
                    //     document.querySelector('#send-test')
                    //     .addEventListener('click', (e) => {

                    //         const formElement = document.querySelector('form')
                    //         const data = {};
                    //         for (const pair of new FormData(formElement)) {
                    //             data[pair[0]] = pair[1];
                    //             data["_method"] = "POST"
                    //         }
                    //         const formData = new FormData(formElement);
                    //         fetch("/send-test-email", {
                    //             headers: {
                    //                 "Content-Type": "application/json",
                    //                 "Accept": "application/json",
                    //                 "X-Requested-With": "XMLHttpRequest",
                    //                 "X-CSRF-Token": formElement._token.value
                    //             },
                    //             credentials: "same-origin",
                    //             method: 'post',
                    //             body: JSON.stringify(data),
                    //         });
                    //     })

                    const cardExpend = (btn, select) => {
                        const ele = document.getElementById(select)
                        ele.classList.toggle('d-none')
                        btn.classList.toggle('bg-gradient-faded-dark')
                        btn.classList.toggle('expend')
                        // btn.innerText == '+' ? btn.innerText = '-' :  btn.innerText = '+'
                    }
                    const tempZoom = (btn, select) => {
                        const ele = document.getElementById(select)
                        ele.classList.toggle('zoom-out')
                        btn.classList.toggle('bg-gradient-faded-dark')
                        btn.classList.toggle('expend')
                        // btn.innerText == '' ? btn.innerText = '-' :  btn.innerText = ''
                    }
                </script>

            </div>
        </div>
        @endsection
