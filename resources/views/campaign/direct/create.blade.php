@extends('layouts.user_type.auth')

@section('content')
    <div class="row">

        <div class="col-4">
            <div class="card">
                <a href="{{ route('campaigns.import.index', ['campaign' => 'import']) }}"
                    class="card-body d-flex flex-column align-items-center pt-2">
                    <i class="fas fa-file-upload fa-7x mt-5"></i>
                    <h5 class="mt-3">
                        From file list.
                    </h5>
                    <p class=" mb-5">
                        Create campane from file
                    </p>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <a href="{{ route('campaigns.create', ['type' => 'contacts']) }}"
                    class="card-body d-flex flex-column align-items-center pt-2">
                    <i class="fas fa-address-book fa-7x mt-5"></i>
                    <h5 class="mt-3">
                        From Contacts.
                    </h5>
                    <p class=" mb-5">
                        Create campane from file
                    </p>
                </a>


            </div>

        </div>
    </div>
@endsection
