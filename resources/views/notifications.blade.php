@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
            <div class="card">
                <div class="card-body p-3">
                    @if($notifications)
                    @foreach($notifications as $notification)
                    <div class="alert alert-light mx-4" role="alert">
                        <span class="text-dark">
                            <a class="text-dark"
                                        href="{{ $notification->data['action'] }}">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">

                                                <i class="avatar-sm cursor-pointer {{ $notification->data['icon'] }} me-3 text-5xl"
                                                    aria-hidden="true"
                                                    style="color:{{ $notification->data['color'] ?? '' }}"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span
                                                        class="font-weight-bold">{{ $notification->data['event'] }}</span>{{ $notification->data['title'] }}
                                                </h6>
                                                <p class="text-xs text-dark mb-1 text-wrap">
                                                    {{ $notification->data['body'] }}
                                                <p class="text-xs text-dark mb-0">
                                                    <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                    <span class="moment">{{ $notification->data['time'] }}</span>

                                                </p>
                                            </div>
                                        </div>
                                    </a>
                
                
                        </span>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
    </div>
@endsection
