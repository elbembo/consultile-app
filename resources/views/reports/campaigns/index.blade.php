@extends('layouts.user_type.auth')

@section('content')
    <div>
        @foreach ($folders as $folder)
        @php
            $messages = $folder->messages()->all()->get() 
        @endphp 
            @foreach ($messages as $message)
            @php
                $message->parseBody();
            @endphp
                <div class="row">
                    <div class="col-md-4">{{ print_r($message->get("references")) }}</div>
                    <div class="col-md-4">{{ $message->getAttachments()->count() }}</div>
                    <div class="col-md-4">@foreach ($message->getBodies() as $body){{ $body }}@endforeach</div>

                </div>
                @endforeach
    </div>
    
    @endforeach
@endsection
