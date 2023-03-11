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
                    <form  id="tempCode" action="{{url('email/templates')}}" method="post">
                    @csrf
                    <div class="row pb-2">
                        <div class="col-6">
                            <label class="form-control-label" for="template_name">Template name</label>
                            <input  class="form-control" type="text" name="template_name" id="template_name" required>
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
                        <textarea id="summernote" name="content" >{{ $code ?? '' }}</textarea>
                        <div class="d-flex justify-content-between">
                            <button id="email-preview" href="{{url('email/template/preview')}}" class="btn bg-gradient-primary btn-md mt-2 mb-0" type="button">Preview</button>
                            <button type="submit" class="btn bg-gradient-primary btn-md mt-2 mb-0" >Save template</button>
                        </div>
                    </form>

                </div>



            </div>
        </div>
    </div>
</div>
<script>
            document.querySelector('#email-preview')
            .addEventListener('click',(e)=>{

                const formElement = document.querySelector('form')
                const data ={};
                for (const pair of new FormData(formElement)) {
                    data[pair[0]] = pair[1];
                    data["_method"] = "POST"
                }
                const formData = new FormData(formElement);
                fetch("/email-preview", {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": formElement._token.value
                    },
                    credentials: "same-origin",
                    method: 'post',
                    body: JSON.stringify(data),
                });
            })

        </script>
@endsection
