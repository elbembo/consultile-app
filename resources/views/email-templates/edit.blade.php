@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Add, Edit, Delete marketing campaign </strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a href="{{url('email/template/preview')}}" class="btn bg-gradient-primary btn-sm mb-1" type="button">+&nbsp; New User</a>
                    </div>
                </div>
                <div class="card-body px-2 py-1">
                    <!-- <form  id="tempCode" action="{{ url('email/templates/'.$emailTemp->id) }}" method="post">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="row pb-2">
                        <div class="col-6">
                            <label class="form-control-label" for="template_name">Template name</label>
                            <input  class="form-control" type="text" name="template_name" id="template_name" value="{{ $emailTemp->template_name ?? '' }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-control-label" for="template_type">Template name</label>
                            <select name="template_type" class="form-control" id="template_type">
                                <option>Default select</option>
                                <option>Header</option>
                                <option>Footer</option>
                            </select>
                        </div>

                    </div>
                    <div class="d-flex">
                        <div class="border border-1 btn custom_data shadow-none" data-value="First Name">First Name</div>
                        <div class="border border-1 btn custom_data shadow-none" data-value="Last Name">Last Name</div>
                        <div class="border border-1 btn custom_data shadow-none" data-value="Title">Title</div>
                        <div class="border border-1 btn custom_data shadow-none" data-value="Email">Email</div>
                    </div>
                    <div class="row">
                        <textarea id="summernote" name="content" >{{ $emailTemp->content ?? '' }}</textarea>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('email/template/preview' )}}" class="btn bg-gradient-primary btn-md mt-2 mb-0" target="_blank">Preview</a>
                            <button type="submit" class="btn bg-gradient-primary btn-md mt-2 mb-0" >Save template</button>
                        </div>
                    </div>
                    </form> -->
                    <iframe src="/editor?{{ isset($emailTemp->id) ? "t=$emailTemp->id" : '' }}" frameborder="0" height="600" seamless></iframe>
                </div>



            </div>
        </div>
    </div>
</div>

@endsection
