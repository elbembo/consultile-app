@extends('layouts.user_type.auth')

@section('content')
    <div>
        @foreach ($contscts as $contact)
            <div class="row">
                {{ $contact->email ?? 'no' }}
            </div>
        @endforeach
        @foreach ($messages as $message)
        @$message->parseBody()
        <div>
            {{$message->getBodies()[0]}}
        </div>
        @endforeach
    </div>
@endsection
