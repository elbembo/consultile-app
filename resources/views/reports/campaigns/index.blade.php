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
            {{print_r($message->getBodies())}}
        </div>
        @endforeach
    </div>
@endsection
