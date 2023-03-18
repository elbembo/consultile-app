
const HelloButton = function (context) {
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
    // $('.moment').text(moment.unix($(this).text()).fromNow())

    // $("#tempCode").on('submit', function () {
    //     $('#tempCodetextarea').html($('#summernote').summernote('code'));
    // });
    $("form").on('submit', (e) => {
        $(this).find('button').prop('disabled', true);

    })

});
(function () {
    async function post(url = "", data = {}, method = "POST") {
        // Default options are marked with *
        const response = await fetch(url, {
            method, // *GET, POST, PUT, DELETE, etc.
            mode: "cors", // no-cors, *cors, same-origin
            cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
            credentials: "same-origin", // include, *same-origin, omit
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
            },
            redirect: "follow", // manual, *follow, error
            referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data), // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }
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
    $s.prototype.blur = function (hand) {
        this.el.forEach(function (element) {
            element.addEventListener('blur', hand);
        });

        return this;
    }
    $s.prototype.blockSubmit = function () {
        this.el.forEach(function (element) {
            console.log(element)
        });

        return this;
    }
    $s.prototype.submitJson = function (action) {
        this.el.forEach(function (element) {
            const data = {};
            for (const pair of new FormData(element)) {
                data[pair[0]] = pair[1];
            }
            post(action, data);
        });

        return this;
    }
    document.querySelectorAll('.moment').forEach((ele) => {
        ele.textContent = moment.unix(ele.textContent).fromNow()
    })

    const checkThisBitch = (e) => {
        e.target?.nextElementSibling?.remove()
        e.target.classList.remove('border-danger')
        document.querySelector('button[type="submit"]').disabled = false
        if (e.target.value == '')
            return
        const { name, value } = e.target
        post("/check-duplicate", { name, value }).then(res => {
            let span = document.createElement('span');
            if (res?.id) {
                e.target.classList.add('border-danger')
                e.target.parentNode.insertBefore(span, e.target.nextSibling);
                span.innerHTML = `<p class="text-danger text-xs mt-2">Its already exist under ${res?.first_name} ${res?.last_name}, click <a href="/contacts/${res?.id}/edit">here</a> to update it.</a></p>`
                document.querySelector('button[type="submit"]').disabled = true
            } else {
                e.target.classList.remove('border-danger')
                e.target?.nextElementSibling?.remove()
                document.querySelector('button[type="submit"]').disabled = false
            }

        });
    }

    $s('.attachment-del').click((ele) => {
        // alert('its work')
        post("/campaigns/attachments", { index: ele.target.dataset.key, id: ele.target.dataset.id }, 'DELETE')
            .then(res => {
                if (res === true) {
                    $s(`.attachment[data-key=${ele.target.dataset.key}]`).remove()
                }
            });
    })
    $s('#send-test').click(() => {

        const formElement = document.querySelector('form')
        const sendTo = document.querySelector('#send-to').value
        if (!sendTo || sendTo == null || sendTo == '') {
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
        post("/send-test-email", data);
    })
    $s('#email-validation').click((e) => {

        post("/email-validation-dns", { id: e.target.dataset.id }).then(res => {
            if (res === true)
                e.target.classList.add('bg-gradient-success')
            else if (res === false)
                e.target.classList.add('bg-gradient-danger')
            else if (res === 'err')
                e.target.classList.add('bg-gradient-faded-warning-vertical')
        });
    })
    $s('input[name="email"]').blur(checkThisBitch)
    $s('input[name*="phone"]').blur(checkThisBitch)

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
