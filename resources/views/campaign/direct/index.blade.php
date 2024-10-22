@extends('layouts.user_type.auth')

@section('content')
    <div>

        <div class="px-md-4 py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Upload Contacts File') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">


                    <form action="" method="POST" enctype="multipart/form-data" role="form text-left">
                        @csrf
                        <div class="row">
                            <div class="col-md-4"><input class="form-control" placeholder="Name this import" type="text"
                                    name="group_name" value="{{ old('group_name') }}" required></div>
                            <div class="col-md-8"><input class="form-control" type="file" name="contacts"
                                    value="{{ old('contacts') }}" required></div>
                                    {{ $campaign }}
                        </div>



                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <button type="submit"
                                    class="btn bg-gray-500 text-white mt-3 btn-sm ">{{ __('Import') }}</button>
                                <div class="form-check form-switch ps-0 ms-2">
                                    <input class="form-check-input mt-1 ms-auto" name="debug" type="checkbox"
                                        value="debug" onclick="">
                                    <span class="ms-1 text-sm">Errors report</span>
                                </div>
                            </div>



                        </div>

                    </form>
                    @error('contacts')
                        {{ $message }}
                    @enderror
                    @if (isset($failures))
                        @foreach ($failures as $failure)
                            <div class="alert alert-danger mx-4" role="alert">
                                <span class="text-white">
                                    <strong>
                                        <span> Row {{ $failure->row() }} skiped : </span>
                                        <span> Reasons ->
                                            @foreach ($failure->errors() as $err)
                                                {{ $err }},
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
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {


        });
    </script>
@endpush
