@extends('layouts.user_type.auth')

@section('content')
    <div id="build-wrap" class="form-wrapper-div"></div>

    <script>
        jQuery(function($) {
            const options = {
                scrollToFieldOnAdd: false,
            }
            $(document.getElementById('build-wrap')).formBuilder(options);
        });
    </script>
@endsection
