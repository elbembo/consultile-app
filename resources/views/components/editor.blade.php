<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="d-flex">
                    <div class="border bg-warning border-1 btn custom_data shadow-none" data-value="First Name">First Name</div>
                    <div class="border bg-warning border-1 btn custom_data shadow-none" data-value="Last Name">Last Name</div>
                    <div class="border bg-warning border-1 btn custom_data shadow-none" data-value="Title">Title</div>
                    <div class="border bg-warning border-1 btn custom_data shadow-none" data-value="Email">Email</div>
                </div>
                <form action="{{Request::get('t') ?'email/templates/'.Request::get('t').'?t='.Request::get('t') : 'email/templates'}}" method="post">
                    @csrf
                    @if(Request::get('t'))
                    @method('PUT')
                    @endif
                    <input type="hidden" name="template_name" value="{{ Request::get('t') ? ($et->name ?? '' ): '' }}">
                    <input type="hidden" name="cid" value="{{ $campaign->id ?? '' }}">

                    <textarea name="content" id="ta-1" cols="30" rows="30">{{ $et->content ?? '' }}</textarea>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>



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
            var content =
                "<p><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzC_Ho_08G0m7PyxJOPLpPujM9UTLxvaE-5nXewscnqa3GMWjGwg' alt='Image result for summernote.js'></p><h1>Summernote</h1>";
            var $sumNote = $("#ta-1")
                .summernote({
                    // callbacks: {
                    //     onPaste: function(e, x, d) {
                    //         $sumNote.code(($($sumNote.code()).find("font").remove()));
                    //     }
                    // },

                    dialogsInBody: true,
                    dialogsFade: true,
                    disableDragAndDrop: true,
                    //                disableResizeEditor:true,
                    height: "400px",
                    buttons: {
                        hello: HelloButton
                    },
                    tableClassName: function() {
                        alert("tbl");
                        $(this)
                            .addClass("table table-bordered")

                            .attr("cellpadding", 0)
                            .attr("cellspacing", 0)
                            .attr("border", 1)
                            .css("borderCollapse", "collapse")
                            .css("table-layout", "fixed")
                            .css("width", "100%");

                        $(this)
                            .find("td")
                            .css("borderColor", "#ccc")
                            .css("padding", "4px");
                    }
                })
                .data("summernote");

            //get
            $("#btn-get-content").on("click", function() {
                var y = $($sumNote.code());

                console.log(y[0]);
                console.log(y.find("p> font"));
                var x = y.find("font").remove();
                $("#content").text($("#ta-1").val());
            });
            //get text$($sumNote.code()).find("font").remove()$($sumNote.code()).find("font").remove()
            $("#btn-get-text").on("click", function() {
                $("#content").html($($sumNote.code()).text());
            });
            //set
            $("#btn-set-content").on("click", function() {
                $sumNote.code(content);
            }); //reset
            $("#btn-reset").on("click", function() {
                $sumNote.reset();
                $("#content").empty();
            });
            $('.custom_data').on('click', (e) => {
                $("#ta-1").summernote('insertText', `@{{ ${e.target.dataset.value} }}`)

            })
        })();
    </script>
</body>

</html>
