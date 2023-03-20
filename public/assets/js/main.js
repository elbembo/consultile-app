
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
    function notifyMini(titel, msg, type) {
        let doc = new DOMParser().parseFromString(
            `<div class="toast fade p-2 mt-2 bg-gradient-${type} hide" role="alert" aria-live="assertive" id="notifyMini"
                aria-atomic="true">
                <div class="toast-header bg-transparent border-0 d-flex">
                    <i class="ni ni-bell-55 text-white me-2"></i>
                    <span class="me-auto text-white font-weight-bold toast-title">${titel} </span>
                    <small class="text-white"></small>
                    <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"
                        aria-hidden="true"></i>
                </div>
                <hr class="horizontal light m-0">
                <div class="toast-body text-white d-flex">
                ${msg} 
                </div>
            </div>`, 'text/html')

        let toastEle = doc.body.querySelector('.toast');
        console.log(toastEle)
        document.getElementById('notifyBase').appendChild(toastEle)
        let toast = new bootstrap.Toast(toastEle)
        toast.show()
        //     var toastElList = [].slice.call(document.querySelectorAll(`.toast`))
        //     var toastList = toastElList.map(function(toastEl) {
        //         // toastEl.querySelector('.toast-title').innerHTML = titel
        //         // toastEl.querySelector('.toast-body').innerHTML = msg
        //     // Creates an array of toasts (it only initializes them)
        //       return new bootstrap.Toast(toastEl) // No need for options; use the default options
        //     });
        //    toastList.forEach(toast => toast.show()); // This show them
    }
    async function post(url = "", data = {}, method = "POST", output = 'json') {
        // Default options are marked with *
        const response = await fetch(url, {
            method, // *GET, POST, PUT, DELETE, etc.
            mode: "cors", // no-cors, *cors, same-origin
            cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
            credentials: "same-origin", // include, *same-origin, omit
            headers: {
                "Content-Type": "application/json",
                "Accept": "*/*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
            },
            redirect: "follow", // manual, *follow, error
            referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data), // body data type must match "Content-Type" header
        });
        return (output == 'json') ? response.json() : response.text(); // parses JSON response into native JavaScript objects
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
    // check input email and phone dubilcate
    const checkThisBitch = (e) => {
        e.target?.nextElementSibling?.remove()
        e.target.classList.remove('border-danger')
        document.querySelector('button[type="submit"]').disabled = false
        if (e.target.value.trim() == '' || e.target.value.trim() == e.target.dataset.default.trim())
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

        const { key, id } = ele.target.dataset
        post("/campaigns/" + id + "/attachments", { index: key, id: id }, 'DELETE')
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
        post("/send-test-email", data).then(res => {
            res?.messageId ? notifyMini('Email sent successfuly', `An test email sent to ${res.send_to} , if you don't receive it please check your spam folder or make sure you present a valid email address`, 'success') : notifyMini('danger')
        });
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
    $s('#profileSubscribeCheck').click((e) => {
        post("/contacts/" + e.target.dataset.id, { subscribe: e.target.checked == true ? 1 : 0 }, 'PUT');
    });
    $s('.close-noti').click((e) => {
        const { id } = e.target.dataset
        post("/notifcations/" + id + '/read', { id: id })
            .then(res => {
                if (res == true) {
                    $s(`.notifications[data-id="${id}"]`).remove()
                }
            });
    });
    $s('input[name="email"]').blur(checkThisBitch)
    $s('input[name*="phone"]').blur(checkThisBitch)
    document.querySelector('#search').addEventListener('keypress', (e) => {
        if (event.key === "Enter") {
            if (e.target.value.length >= 3) {
                const first = new URL(location.href).pathname.split("/")[1]
                post(`/${first}/search`, { trim: e.target.value }, 'POST', 'html')
                    .then(res => {
                        document.querySelector('#result').innerHTML = res
                        console.log(res)
                    });
            }
        }
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
