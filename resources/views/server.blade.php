@extends('layouts.user_type.auth')

@section('content')
    <div class="alert alert-danger " role="alert">
        <span class="text-white">
            <strong>Warning don't change anything if you don't know what you do , any unknown change can make a huge
                damage.</strong>
            <strong>This part has a sensitive data be careful.</strong>


        </span>
    </div>
    <div class="row">
        <div class="card">

                @if (!empty($envs))
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-check form-switch ps-0">
                            <input data-id="24" class="form-check-input green ms-auto" type="checkbox" id="Production"
                                {{ $envs['APP_ENV'] == 'local' ? '' : 'checked' }}>
                            <label class="form-check-label text-body ms-3 text-truncate  mb-0"
                                for="Production">Production</label>
                        </div>
                        @foreach ($envs as $key => $value)
                            <div class="form-group">
                                <label for="{{ $key }}" class="form-label">{{ $key }}</label>
                                <input id="{{ $key }}" type="text" name="{{ $key }}"
                                    value="{{ $value }}" class="form-control">
                            </div>
                        @endforeach
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $s('#Production').click((e) => {
            let env = "production"
            let chk = e.target.checked
            if (chk)
                env = "production"
            else
                env = "local"
            post('/server', {
                env
            }).then(res => {
                if (res.state == true) {
                    if (res.msg == "production")
                        e.target.checked = true
                    else
                        e.target.checked = false
                } else {
                    e.target.checked = chk
                }

            })

        })
    </script>
@endpush
