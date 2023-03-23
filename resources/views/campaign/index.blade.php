@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Add, Edit, Delete marketing campaign </strong>


        </span>
    </div>
    <div class="row mx-3">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Campaigns</h5>
                        </div>
                        <a href="{{url('campaigns/create')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">
                            {{ '+ New Campaigns' }}</a>
                    </div>

                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="row px-0">
                        @if(isset($campaigns))
                        @foreach($campaigns as $campaign)
                        <li class="col-md-6 d-inline">
                            <div class=" border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg ">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{ $campaign->name }}</h6>
                                    <span class="mb-2 text-xs">Status: {!! statusBadg($campaign->status,' text-white
                                        ms-sm-2 font-weight-bold') !!}</span>
                                    <span class="mb-2 text-xs">Sent: <span class="text-dark ms-sm-2 font-weight-bold">{{ $campaign->audience_done."/" }}{{ $campaign->total_audience }}</span></span>
                                    <span class="text-xs">Priority: <span class="text-dark ms-sm-2 font-weight-bold">{!!
                                            priority($campaign->campaign_priority) !!}</span></span>
                                </div>
                                <div class="ms-auto text-end d-flex justify-content-between  flex-column">
                                    <div class="">
                                        @if($campaign->status == 'completed' || $campaign->status == 'processing' )
                                        <a class="btn btn-link text-success px-3 mb-0" href="campaigns/{{$campaign->id}}">
                                            <i class="fas  fa-eye text-success me-2" aria-hidden="true"></i>View
                                        </a>
                                        @else
                                        <form action="{{ url('campaigns/' . $campaign->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                <i class="far fa-trash-alt me-2"></i>Delete
                                            </button>
                                        </form>
                                        @endif
                                        <a class="btn btn-link text-dark px-3 mb-0" href="campaigns/{{$campaign->id}}/edit"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>

                                    </div>
                                    <div class="align-items-center text-sm">
                                        @if(is_array($campaign->details) && count($campaign->details) > 0)
                                        <i class="fa fa-paperclip  me-2" title="Has Attachment"></i>
                                        @endif
                                        <i class="far fa-calendar-alt me-2"></i>
                                        <small>{{date('d M Y h:j a', strtotime($campaign->created_at))}}</small>
                                    </div>
                                </div>

                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="row">
                        <div class="d-flex justify-content-center">{{ $campaigns->links() }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
