@extends('layouts.user_type.auth')

@section('content')
    <div>


        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            <a href="{{ url('email/template/preview') }}" class="btn bg-gradient-primary btn-sm mb-1"
                                type="button">+&nbsp; New User</a>
                        </div>
                    </div>

                    <div class="card-body px-2 py-1">
                        <iframe src="/editor?{{ isset($emailTemp->id) ? "t=$emailTemp->id" : '' }}" frameborder="0"
                            height="600" seamless></iframe>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
