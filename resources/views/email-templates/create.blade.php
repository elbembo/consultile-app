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

                        <form id="tempCode" action="{{ url('email/templates') }}" method="post">
                            @csrf
                            <div class="row pb-2">
                                <div class="col-6">
                                    <label class="form-control-label" for="template_name">Template name</label>
                                    <input class="form-control" type="text" name="template_name" id="template_name"
                                        required>
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
                                <div class=" bg-light btn btn-link custom_data  p-2 m-1 " data-value="First Name">
                                    First
                                    Name</div>
                                <div class=" bg-light btn btn-link custom_data p-2 m-1 " data-value="Last Name">
                                    Last Name
                                </div>
                                <div class=" bg-light btn btn-link custom_data  p-2 m-1 " data-value="Title">Title
                                </div>
                                <div class=" bg-light btn btn-link custom_data  p-2 m-1 " data-value="Email">Email
                                </div>
                                <div class=" bg-light btn btn-link unsubscribe-btn  p-2 m-1 " data-value="Email">
                                    Unsubscribe link</div>
                            </div>
                            <textarea id="summernote" name="content">{{ $code ?? '' }}</textarea>
                            <div class="d-flex justify-content-between">
                                <button id="email-preview" href="{{ url('email/template/preview') }}"
                                    class="btn bg-gradient-primary btn-md mt-2 mb-0" type="button">Preview</button>
                                <button type="submit" class="btn bg-gradient-primary btn-md mt-2 mb-0">Save
                                    template</button>
                            </div>
                        </form>

                    </div>



                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            function sendFile(file, editor, welEditable) {
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: "/upload",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        var image = $('<img>').attr('src', url);
                        image.attr('alt', "");
                        $('#summernote').summernote("insertNode", image[0]);
                    }
                });
            }
            $('#summernote').summernote({
                // dialogsInBody: true,
                dialogsFade: true,
                disableDragAndDrop: true,
                height: "500px",

                toolbar: [
                    ['style'],
                    ['undo', ['undo', ]],
                    ['redo', ['redo', ]],
                    ['style', ['bold', 'italic', 'underline', ]],
                    ['font', ['strikethrough', ]],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table'],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['codeview', ['codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files, editor, welEditable) {
                        sendFile(files[0], editor, welEditable);
                    }
                },
                tableClassName: function() {
                    $(this)
                        .addClass("table table-bordered")

                        .attr("cellpadding", 0)
                        .attr("cellspacing", 0)
                        .attr("border", 0)
                        .css("borderCollapse", "collapse")
                        .css("table-layout", "fixed")
                        .css("width", "100%");

                    $(this)
                        .find("td")
                        .css("borderColor", "#ccc")
                    // .css("padding", "4px");
                }
            });

            $('.custom_data').on('click', (e) => {
                $('#summernote').summernote('insertText', `@{{ ` + e.target.dataset.value + ` }}`)
            })
            $('.unsubscribe-btn').on('click', (e) => {
                $("#summernote").summernote('createLink', {
                    text: "Unsubscribe",
                    url: 'https://app.consultile.com/unsubscribe/?t=@{{ Traker }}',
                    isNewWindow: true
                })

            })

        });
        document.querySelector('#email-preview')
            .addEventListener('click', (e) => {

                const formElement = document.querySelector('form')
                const data = {};
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
