
(() => {
    const $s = function (selector) {
        if (!(this instanceof $s)) {
            return new $(selector);
        }
        this.el = document.querySelectorAll(selector);
        return this;
    }

    $s.prototype.css = function (prop, val) {
        this.el.forEach(function (element) {
            element.style[prop] = val;
        });

        return this;
    }
    $s.prototype.click = function (hand) {
        this.el.forEach(function (element) {
            element.addEventListener('ckick', hand);
        });

        return this;
    }
    var HelloButton = function (context) {
        var ui = $.summernote.ui;

        // create button
        var button = ui.button({
            contents: '<i class="fa fa-child"/> Hello',
            tooltip: 'hello',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                context.invoke('editor.insertText', 'hello');
            }
        });

        return button.render();   // return button as jquery object
    }
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 500,
            styleTags: [
                'p',
                {
                    title: 'Blockquote',
                    tag: 'blockquote',
                    className: 'blockquote',
                    value: 'blockquote'
                },
                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            },
            buttons: {
                hello: HelloButton
            },
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['red']],
                ['para', ['style', 'ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });
        $('.custom_data').on('click', (e) => {
            $('#summernote').summernote('insertText', `{{ ${e.target.dataset.value} }}`)
        })

        // $("#tempCode").on('submit', function () {
        //     $('#tempCodetextarea').html($('#summernote').summernote('code'));
        // });
    });
    $s('.attachment-del').click(() => {
        // alert('its work')
        console.log(this)
    })
    $s('#send-test').click(() => {

        const formElement = document.querySelector('form')
        const sendTo = document.querySelector('#send-to').value
        if(!sendTo || sendTo == null || sendTo == ''){
            alert('Set email in test email failed to send')
            return
        }
        const data = {};
        for (const pair of new FormData(formElement)) {
            data[pair[0]] = pair[1];

        }
        data["_method"] = "POST"
        data["send_to"] = sendTo
        const formData = new FormData(formElement);
        fetch("/send-test-email", {
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

})()
// function resizeIFrameToFitContent(iFrame) {

//     // iFrame.width = iFrame.contentWindow.document.body.scrollWidth;
//     iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
// }

// window.addEventListener('DOMContentLoaded', function (e) {

//     // var iFrame = document.getElementById( 'iFrame1' );
//     // resizeIFrameToFitContent( iFrame );

//     // or, to resize all iframes:
//     var iframes = document.querySelectorAll("iframe");
//     for (var i = 0; i < iframes.length; i++) {
//         resizeIFrameToFitContent(iframes[i]);
//     }
// });
