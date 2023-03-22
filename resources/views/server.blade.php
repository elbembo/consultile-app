@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body p-3">
                @if(!empty($envs))
                <form action="" method="post">
                    @csrf
                    @method('PUT')
                    @foreach($envs as $key => $value)
                    <div class="form-group">
                        <label for="{{$key}}" class="form-label">{{$key}}</label>
                        <input id="{{$key}}" type="text" name="{{$key}}" value="{{$value}}" class="form-control">
                    </div>
                    @endforeach
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
