@extends('layouts.user_type.auth')

@section('content')
    <div>
        @foreach ($contscts as $contact)
            <div class="row">
                {{ $contact->email ?? 'no' }}
            </div>
        @endforeach
        @foreach ($reads as $message).
        @php
            $message->parseBody()
        @endphp
        <div>
            {{print_r($message->getBodies()['text'])}}
            {{-- @foreach(preg_split("/((\r?\n)|(\r\n?))/", $message->getBodies()->text) as $line)
                {{$line}}
            @endforeach --}}

        </div>
        @endforeach
    </div>
@endsection
