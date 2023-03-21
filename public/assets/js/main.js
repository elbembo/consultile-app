
document.querySelector(".fixed-plugin") && (fixedPlugin = document.querySelector(".fixed-plugin"),
fixedPluginButton = document.querySelector(".fixed-plugin-button"),
fixedPluginButtonNav = document.querySelector(".fixed-plugin-button-nav"),
fixedPluginCard = document.querySelector(".fixed-plugin .card"),
fixedPluginCloseButton = document.querySelectorAll(".fixed-plugin-close-button"),
navbar = document.getElementById("navbarBlur"),
buttonNavbarFixed = document.getElementById("navbarFixed"),
fixedPluginButton && (fixedPluginButton.onclick = function() {
    fixedPlugin.classList.contains("show") ? fixedPlugin.classList.remove("show") : fixedPlugin.classList.add("show")
}
),
fixedPluginButtonNav && (fixedPluginButtonNav.onclick = function() {
    fixedPlugin.classList.contains("show") ? fixedPlugin.classList.remove("show") : fixedPlugin.classList.add("show")
}
),
fixedPluginCloseButton.forEach(function(e) {
    e.onclick = function() {
        fixedPlugin.classList.remove("show")
    }
}),
document.querySelector("body").onclick = function(e) {
    e.target != fixedPluginButton && e.target != fixedPluginButtonNav && e.target.closest(".fixed-plugin .card") != fixedPluginCard && fixedPlugin.classList.remove("show")
}
,
navbar && "true" == navbar.getAttribute("data-scroll") && buttonNavbarFixed && buttonNavbarFixed.setAttribute("checked", "true"));
var sidenavToggler, sidenavShow, toggleNavbarMinimize, total = document.querySelectorAll(".nav-pills");
function initNavs() {
    total.forEach(function(l, e) {
        var o = document.createElement("div")
          , t = l.querySelector("li:first-child .nav-link").cloneNode();
        t.innerHTML = "-",
        o.classList.add("moving-tab", "position-absolute", "nav-link"),
        o.appendChild(t),
        l.appendChild(o);
        l.getElementsByTagName("li").length;
        o.style.padding = "0px",
        o.style.width = l.querySelector("li:nth-child(1)").offsetWidth + "px",
        o.style.transform = "translate3d(0px, 0px, 0px)",
        o.style.transition = ".5s ease",
        l.onmouseover = function(e) {
            let t = getEventTarget(e)
              , i = t.closest("li");
            if (i) {
                let n = Array.from(i.closest("ul").children)
                  , a = n.indexOf(i) + 1;
                l.querySelector("li:nth-child(" + a + ") .nav-link").onclick = function() {
                    o = l.querySelector(".moving-tab");
                    let e = 0;
                    if (l.classList.contains("flex-column")) {
                        for (var t = 1; t <= n.indexOf(i); t++)
                            e += l.querySelector("li:nth-child(" + t + ")").offsetHeight;
                        o.style.transform = "translate3d(0px," + e + "px, 0px)",
                        o.style.height = l.querySelector("li:nth-child(" + t + ")").offsetHeight
                    } else {
                        for (t = 1; t <= n.indexOf(i); t++)
                            e += l.querySelector("li:nth-child(" + t + ")").offsetWidth;
                        o.style.transform = "translate3d(" + e + "px, 0px, 0px)",
                        o.style.width = l.querySelector("li:nth-child(" + a + ")").offsetWidth + "px"
                    }
                }
            }
        }
    })
}
function getEventTarget(e) {
    return (e = e || window.event).target || e.srcElement
}
setTimeout(function() {
    initNavs()
}, 100),
window.addEventListener("resize", function(e) {
    total.forEach(function(n, e) {
        n.querySelector(".moving-tab").remove();
        var a = document.createElement("div")
          , i = n.querySelector(".nav-link.active").cloneNode();
        i.innerHTML = "-",
        a.classList.add("moving-tab", "position-absolute", "nav-link"),
        a.appendChild(i),
        n.appendChild(a),
        a.style.padding = "0px",
        a.style.transition = ".5s ease";
        let l = n.querySelector(".nav-link.active").parentElement;
        if (l) {
            let e = Array.from(l.closest("ul").children);
            i = e.indexOf(l) + 1;
            let t = 0;
            if (n.classList.contains("flex-column")) {
                for (var o = 1; o <= e.indexOf(l); o++)
                    t += n.querySelector("li:nth-child(" + o + ")").offsetHeight;
                a.style.transform = "translate3d(0px," + t + "px, 0px)",
                a.style.width = n.querySelector("li:nth-child(" + i + ")").offsetWidth + "px",
                a.style.height = n.querySelector("li:nth-child(" + o + ")").offsetHeight
            } else {
                for (o = 1; o <= e.indexOf(l); o++)
                    t += n.querySelector("li:nth-child(" + o + ")").offsetWidth;
                a.style.transform = "translate3d(" + t + "px, 0px, 0px)",
                a.style.width = n.querySelector("li:nth-child(" + i + ")").offsetWidth + "px"
            }
        }
    }),
    window.innerWidth < 991 ? total.forEach(function(a, e) {
        if (!a.classList.contains("flex-column")) {
            a.classList.remove("flex-row"),
            a.classList.add("flex-column", "on-resize");
            let e = a.querySelector(".nav-link.active").parentElement
              , t = Array.from(e.closest("ul").children);
            t.indexOf(e);
            let n = 0;
            for (var i = 1; i <= t.indexOf(e); i++)
                n += a.querySelector("li:nth-child(" + i + ")").offsetHeight;
            var l = document.querySelector(".moving-tab");
            l.style.width = a.querySelector("li:nth-child(1)").offsetWidth + "px",
            l.style.transform = "translate3d(0px," + n + "px, 0px)"
        }
    }) : total.forEach(function(a, e) {
        if (a.classList.contains("on-resize")) {
            a.classList.remove("flex-column", "on-resize"),
            a.classList.add("flex-row");
            let e = a.querySelector(".nav-link.active").parentElement
              , t = Array.from(e.closest("ul").children);
            var i = t.indexOf(e) + 1;
            let n = 0;
            for (var l = 1; l <= t.indexOf(e); l++)
                n += a.querySelector("li:nth-child(" + l + ")").offsetWidth;
            var o = document.querySelector(".moving-tab");
            o.style.transform = "translate3d(" + n + "px, 0px, 0px)",
            o.style.width = a.querySelector("li:nth-child(" + i + ")").offsetWidth + "px"
        }
    })
}),
window.innerWidth < 991 && total.forEach(function(e, t) {
    e.classList.contains("flex-row") && (e.classList.remove("flex-row"),
    e.classList.add("flex-column", "on-resize"))
}),
document.querySelector(".sidenav-toggler") && (sidenavToggler = document.getElementsByClassName("sidenav-toggler")[0],
sidenavShow = document.getElementsByClassName("g-sidenav-show")[0],
toggleNavbarMinimize = document.getElementById("navbarMinimize"),
sidenavShow && (sidenavToggler.onclick = function() {
    sidenavShow.classList.contains("g-sidenav-hidden") ? (sidenavShow.classList.remove("g-sidenav-hidden"),
    sidenavShow.classList.add("g-sidenav-pinned"),
    toggleNavbarMinimize && (toggleNavbarMinimize.click(),
    toggleNavbarMinimize.removeAttribute("checked"))) : (sidenavShow.classList.remove("g-sidenav-pinned"),
    sidenavShow.classList.add("g-sidenav-hidden"),
    toggleNavbarMinimize && (toggleNavbarMinimize.click(),
    toggleNavbarMinimize.setAttribute("checked", "true")))
}
));
const iconNavbarSidenav = document.getElementById("iconNavbarSidenav")
  , iconSidenav = document.getElementById("iconSidenav")
  , sidenav = document.getElementById("sidenav-main");
let body = document.getElementsByTagName("body")[0]
  , className = "g-sidenav-pinned";
function toggleSidenav() {
    body.classList.contains(className) ? (body.classList.remove(className),
    setTimeout(function() {
        sidenav.classList.remove("bg-white")
    }, 100),
    sidenav.classList.remove("bg-transparent")) : (body.classList.add(className),
    sidenav.classList.add("bg-white"),
    sidenav.classList.remove("bg-transparent"),
    iconSidenav.classList.remove("d-none"))
}
iconNavbarSidenav && iconNavbarSidenav.addEventListener("click", toggleSidenav),
iconSidenav && iconSidenav.addEventListener("click", toggleSidenav);
let referenceButtons = document.querySelector("[data-class]");
function navbarColorOnResize() {
    sidenav && (1200 < window.innerWidth ? referenceButtons.classList.contains("active") && "bg-transparent" === referenceButtons.getAttribute("data-class") ? sidenav.classList.remove("bg-white") : sidenav.classList.add("bg-white") : (sidenav.classList.add("bg-white"),
    sidenav.classList.remove("bg-transparent")))
}
function sidenavTypeOnResize() {
    let e = document.querySelectorAll('[onclick="sidebarType(this)"]');
    window.innerWidth < 1200 ? e.forEach(function(e) {
        e.classList.add("disabled")
    }) : e.forEach(function(e) {
        e.classList.remove("disabled")
    })
}
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

    $('#summernote').summernote(
    );
    $('.custom_data').on('click', (e) => {
        $('#summernote').summernote('insertText', `{{ ${e.target.dataset.value} }}`)
    })
    // $('.moment').text(moment.unix($(this).text()).fromNow())

    // $("#tempCode").on('submit', function () {
    //     $('#tempCodetextarea').html($('#summernote').summernote('code'));
    // });
    // $("form").on('submit', (e) => {
    //     $(this).find('button').prop('disabled', true);

    // })

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
    
    document.querySelectorAll('.moment').forEach((ele) => {
        ele.textContent = moment.unix(ele.textContent).fromNow()
    })
    // check input email and phone dubilcate
    
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
    // $s('input[name="email"]').blur(checkThisBitch)
    // $s('input[name*="phone"]').blur(checkThisBitch)
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
