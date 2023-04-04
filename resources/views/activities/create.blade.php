@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class=" mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <form action="/activities" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="url">Link of client account</label>
                                <input type="url" name="url" id="url" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="linkedin-accounts">Linkedin Account</label>
                                <select name="account" id="linkedin-accounts" class="form-control" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($accountsList as $item)
                                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="communicate-action">Ccommunicate Action</label>
                                <select name="action" id="communicate-action" class="form-control" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($actionList as $item)
                                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <button id="activity-submit" type="submit" name="submitBtn" class="btn bg-gradient-dark btn-md mt-4 mb-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
