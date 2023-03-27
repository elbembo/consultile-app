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


                    <textarea name="content" id="ta-1" cols="30" rows="30">{{ $et->content ?? '<center><table class="table table-bordered" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; table-layout: fixed; max-width: 600px;"><tbody><tr><td style="border-color: rgb(204, 204, 204); padding: 4px;"><br></td></tr></tbody></table></center>' }}</textarea>
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
        (function() {
            var HelloButton = function(context) {
                var ui = $.summernote.ui;

                // create button
                var button = ui.button({
                    contents: '<i class="fa fa-child"/> Hello',
                    tooltip: 'hello',
                    click: function() {
                        // invoke insertText method with 'hello' on editor module.
                        context.invoke('editor.insertText', 'hello');
                    }
                });

                return button.render(); // return button as jquery object
            }
            $("#ta-1")
                .summernote({
                    // callbacks: {
                    //     onPaste: function(e, x, d) {
                    //         $sumNote.code(($($sumNote.code()).find("font").remove()));
                    //     }
                    // },

                    // dialogsInBody: true,
                    dialogsFade: true,
                    disableDragAndDrop: true,
                    //                disableResizeEditor:true,
                    height: "500px",
                    // buttons: {
                    //     hello: HelloButton
                    // },
                    // popover: {
                    //     image: [
                    //         ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    //         ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    //         ['remove', ['removeMedia']],
                    //         ['custom', ['imageTitle']],
                    //     ],
                    // },
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
                        ['picture', ['picture', 'link', 'codeview']]
                    ],

                    // popover: {
                    //     image: [
                    //         ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    //         ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    //         ['remove', ['removeMedia']]
                    //     ],
                    //     link: [
                    //         ['link', ['linkDialogShow', 'unlink']]
                    //     ],
                    //     table: [
                    //         ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    //         ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    //     ],
                    //     air: [
                    //         ['color', ['color']],
                    //         ['font', ['bold', 'underline', 'clear']],
                    //         ['para', ['ul', 'paragraph']],
                    //         ['table', ['table']],
                    //         ['insert', ['link', 'picture']]
                    //     ]
                    // },
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
                        $('#ta-1').summernote("insertNode", image[0]);
                    }
                });
            }
            $('.custom_data').on('click', (e) => {
                $("#ta-1").summernote('insertText', `@{{ ` +  e.target.dataset.value +` }}`)

            })
            $('.unsubscribe-btn').on('click', (e) => {
                $("#ta-1").summernote('createLink', {
                    text: "Unsubscribe",
                    url: 'https://app.consultile.com/unsubscribe/?t=@{{ Traker }}',
                    isNewWindow: true
                })

            })
        })();
    </script>
</body>

</html>
