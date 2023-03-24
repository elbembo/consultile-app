@extends('layouts.user_type.auth')

@section('content')
    <div>
        @foreach($contscts as $contact)
        $contact->email

        {{-- @foreach ($folders as $folder)
            @php
                $query = $folder->search();
                $messages = $query->text('message that you sent could not be delivered')->get();
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
                        {{-- @foreach ($message->getBodies() as $body)
                            {{ $body }}
                        @endforeach --}}
                    {{-- </div>

                </div>
            @endforeach --}} --}}
        @endforeach
    </div>

@endsection
