@extends('layouts.user_type.auth')

@section('content')
    @if (isset($campaign))
        <div class="row">
            <div class="col-md-12 mt-8">
                <div class="card bg-gradient-secondary">
                    <div class="card-body px-5 z-index-1 bg-cover">
                        <div class="row">
                            <div class="col-lg-3 col-12 my-auto">
                                <h4 class="text-white opacity-9">{{ $campaign->name }}</h4>
                                <hr class="horizontal light mt-1 mb-3">
                                <div class="d-flex">
                                    <div>
                                        <h6 class="mb-0 text-white opacity-7">Total Audience</h6>
                                        <h3 class="text-white">{{ $campaign->total_audience }} <small
                                                class="text-sm align-top"></small></h3>
                                    </div>
                                    <div class="ms-lg-6 ms-4">
                                        <h6 class="mb-0 text-white opacity-7">Completed</h6>
                                        <h3 class="text-white">{{ $campaign->audience_done }} <small
                                                class="text-sm align-top"></small></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 text-center">
                                <div class="mt-n7 mt-lg-n8 d-none d-md-block overflow-hidden"
                                    style="height: 255px;width: 436px;box-shadow:-20px 20px 27px 0 rgba(0,0,0,12%);
                                    border-radius: 0.5rem;margin-bottom: 21px!important;">
                                    <a href="{{url('email/template/preview/'.$temp->id)}}" target="_blank">View full email</a>
                                    <div style="zoom: 0.6;">{!! $temp->content !!}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h4 class="text-white opacity-7 ms-0 ms-md-auto">Completed</h4>
                                    <h2 class="text-white ms-2 me-auto">
                                        @if ($campaign->total_audience != 0)
                                            {{ floor(($campaign->audience_done / $campaign->total_audience) * 100) }}
                                        @else
                                            {{ __('0') }}
                                        @endif
                                        <small class="text-sm align-top"> %</small>
                                    </h2>
                                </div>
                                {{-- <div class="temp-snap">
                                    {!! $temp->content !!}

                                </div> --}}
                            </div>
                            <div class="col-lg-3 col-12 my-auto">
                                <h4 class="text-white opacity-9">Status</h4>
                                <hr class="horizontal light mt-1 mb-3">
                                <div class="d-flex">
                                    <div>
                                        <h6 class="mb-0 text-white">Sent : {{$tracking[0]->delivered}}</h6>
                                        <h6 class="mb-0 text-white">Read : {{$tracking[0]->opend}}</h6>
                                        <h6 class="mb-0 text-white">views : {{$tracking[0]->views}}</h6>
                                    </div>
                                    <div class="ms-lg-6 ms-4">
                                        {{-- <button class="btn btn-icon-only btn-rounded btn-outline-white mb-0">
                                            <i class="ni ni-map-big" aria-hidden="true"></i>
                                        </button> --}}
                                        <form action="{{ url('campaigns/' . $campaign->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon-only btn-rounded btn-outline-white mb-0">
                                                <i class="far fa-trash-alt me-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
