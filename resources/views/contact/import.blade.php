@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Upload Contacts File') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">


                <form action="" method="POST" enctype="multipart/form-data" role="form text-left">
                    @csrf
                    <input class="form-control" type="file" name="contacts" value="{{old('contacts')}}">
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn bg-gray-500 text-white mt-3 btn-sm m-1">{{ __('Import') }}</button>
                        <a href="{{route('contacts.export.example')}}" class="link  mt-3 align-self-end">download example file</a>
                    </div>

                </form>
                @error('contacts')
                {{ $message }}
                @enderror
                @if(isset($failures))
                @foreach ($failures as $failure)
                <div class="alert alert-danger mx-4" role="alert">
                    <span class="text-white">
                        <strong>
                            <span> Row {{$failure->row()}} for {{ $failure->values()["first_name"] }} {{ $failure->values()["last_name"] }} skiped : </span>
                            <span> Reasons ->
                                @foreach($failure->errors() as $err)
                                {{$err}},
                                @endforeach
                            </span>
                        </strong>
                    </span>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
