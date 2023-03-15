@extends('layouts.user_type.auth')

@section('content')
    @if (isset($campaign))
        <div class="row">
            <div class="col-md-12 mt-4">
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
                                        <h6 class="mb-0 text-white opacity-7">Achieved</h6>
                                        <h3 class="text-white">{{ $campaign->audience_done }} <small class="text-sm align-top"></small></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 text-center">
                                {{-- <div class="w-75 w-lg-auto mt-n7 mt-lg-n8 d-none d-md-block"> s</div> --}}
                                <div class="d-flex align-items-center">
                                    <h4 class="text-white opacity-7 ms-0 ms-md-auto">Achieved</h4>
                                    <h2 class="text-white ms-2 me-auto">
                                        {{ ($campaign->audience_done / $campaign->total_audience) * 100 }}<small
                                            class="text-sm align-top"> %</small></h2>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12 my-auto">
                                <h4 class="text-white opacity-9">Status</h4>
                                <hr class="horizontal light mt-1 mb-3">
                                <div class="d-flex">
                                    <div>
                                        <h6 class="mb-0 text-white">Miclan, DW</h6>
                                        <h6 class="mb-0 text-white">891 Limarenda road</h6>
                                    </div>
                                    <div class="ms-lg-6 ms-4">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-white mb-0">
                                            <i class="ni ni-map-big" aria-hidden="true"></i>
                                        </button>
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
