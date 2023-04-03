@extends('layouts.user_type.auth')

@section('content')
    <div class="overflow-auto row log-err">

            @php
                $logFile = file(storage_path() . '/logs/laravel.log');
                $logCollection = [];
                // Loop through an array, show HTML source as HTML source; and line numbers too.
                foreach ($logFile as $line_num => $line) {
                    $logCollection[] = ['line' => $line_num, 'content' => htmlspecialchars($line)];
                }
            @endphp

            @foreach ($logCollection as $log)
                {!! str_contains($log['content'], '.ERROR') ?  $log['content'] . '<hr>' : '' !!}
            @endforeach
    </div>
@endsection
