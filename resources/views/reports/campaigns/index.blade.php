@extends('layouts.user_type.auth')

@section('content')
    <div>
        @foreach ($folders as $folder)
            @php
                $query = $folder->search();
                $messages = $query->text('This is')->get();
                // dd($messages);
            @endphp
            @foreach ($messages as $message)
                @php
                    $message->parseBody();
                @endphp
                <div class="row">
                    <div class="col-md-6">
                        @php
                        $parts = explode('@', $message->references );
                        $msgid = $parts[0];
                        @endphp
                        {{ str_replace("<","",$msgid) }}
                    </div>
                    <div class="col-md-2">{{ $message->uid }}</div>
                    <div class="col-md-4">
                        @foreach ($message->getBodies() as $body)
                            {{ $body }}
                        @endforeach
                    </div>

                </div>
            @endforeach
    </div>
    @endforeach
@endsection