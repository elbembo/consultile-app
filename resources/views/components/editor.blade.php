<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link id="appstyle" href="/assets/css/core.css?v=1.0.3" rel="stylesheet" />
    <script src="/assets/js/plugins/jquery-3.5.1.min.js"></script>
    <link href="/assets/css/summernote-lite.min.css" rel="stylesheet">
    <script src="/assets/js/plugins/summernote-lite.min.js"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="/assets/js/init.js?v=1.0.5"></script>
    <style>
        .note-modal.open {
            opacity: 1 !important;
        }

        #mini-gallery {

            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 90%;
            overflow: scroll;
            width: 90%;
            z-index: 999;
            background-color: #cbcbcb;

        }
        #mini-gallery img{
            cursor: pointer;
        }
        .overlay-gallery {
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: #000000bf;
            top: 0;
            left: 0;
            z-index: 999;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
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
                <form
                    action="{{ Request::get('t') ? 'email/templates/' . Request::get('t') . '?t=' . Request::get('t') : 'email/templates' }}"
                    method="post">
                    @csrf
                    @if (Request::get('t'))
                        @method('PUT')
                    @endif
                    <input type="hidden" name="template_name"
                        value="{{ Request::get('t') ? $et->template_name ?? ($campaign->name ?? '') : $campaign->id ?? '' }}">
                    <input type="hidden" name="cid" value="{{ $campaign->id ?? '' }}">


                    <textarea name="content" id="summernote" cols="30" rows="30">{{ $et->content ?? '<center><table class="table table-bordered" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; table-layout: fixed; max-width: 600px;"><tbody><tr><td style="border-color: rgb(204, 204, 204); padding: 4px;"><br></td></tr></tbody></table></center>' }}</textarea>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xs-12 text-right">
                <button class="btn btn-sm btn-primary" id="btn-get-content">Get Content</button>
                <button class="btn btn-sm btn-primary" id="btn-get-text">Get Text</button>
                <button class="btn btn-sm btn-success" id="btn-set-content">Set Content</button>
                <button class="btn btn-sm btn-danger" id="btn-reset">Reset</button>
            </div>
        </div> -->
        <hr>
        <div class="row">
            <code class="col-xs-12" id="content">
            </code>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            const GalleryButton = function(context) {
                var ui = $.summernote.ui;

                // create button
                var button = ui.button({
                    contents: '<i class="fa fa-images"/>',
                    // tooltip: 'Gallery',
                    click: function() {
                        // invoke insertText method with 'hello' on editor module.
                        // context.invoke('editor.insertText', 'hello');

                        $.ajax({
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}'
                            },
                            type: "GET",
                            url: "/gallery",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(data) {

                                $('.container-fluid').append(data)
                            }
                        });
                    }
                });

                return button.render(); // return button as jquery object
            }
            $("#summernote")
                .summernote({
                    dialogsFade: true,
                    disableDragAndDrop: true,
                    height: "500px",

                    toolbar: [
                        ['style'],
                        ['undo', ['undo', 'redo']],
                        ['style', ['bold', 'italic', 'underline', ]],
                        ['font', ['strikethrough', 'fontname', 'fontsize', 'color','height']],
                        ['table'],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['picture', ['picture', 'gallery', 'link', 'codeview']],
                    ],
                    buttons: {
                        gallery: GalleryButton
                    },
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

            //get
            function sendFile(file, editor, welEditable) {
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: "upload",
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
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],
            });
            $('.custom_data').on('click', (e) => {
                $("#summernote").summernote('insertText', `@{{ ` +  e.target.dataset.value +` }}`)

            })
            $('.unsubscribe-btn').on('click', (e) => {
                $("#summernote").summernote('createLink', {
                    text: "Unsubscribe",
                    url: 'https://subscribe.consultile.com/unsubscribe/?t=@{{ Traker }}',
                    isNewWindow: true
                })

            })
        });
    </script>
</body>

</html>
