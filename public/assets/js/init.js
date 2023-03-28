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
    response.status !=  200 && window.location.replace("/login");
    return (output == 'json') ? response.json() : response.text(); // parses JSON response into native JavaScript objects
}
function check(url = "", data = {}, method = "POST", output = 'json') {
    // Default options are marked with *
    const response = fetch(url, {
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
function $s(selector) {
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
$s.prototype.on = function (event, handel) {
    this.el.forEach(function (element) {
        element.addEventListener(event, handel)
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
const checkThisBitch = async (e) => {
    result =
    ele = e?.target ? e?.target : e

    if (ele.value.trim() == '' || ele.value.trim() == ele.dataset.default.trim())
        return true
    const { name, value } = ele
    check("/check-duplicate", { name, value }).then(res => {
        let span = document.createElement('span');
        if (res?.id) {
            ele.classList.add('border-danger')
            ele.parentNode.insertBefore(span, ele.nextSibling);
            span.innerHTML = `<p class="text-danger text-xs mt-2">Its already exist under ${res?.first_name} ${res?.last_name}, click <a href="/contacts/${res?.id}/edit">here</a> to update it.</a></p>`
            return false
        } else {
            ele.classList.remove('border-danger')
            ele?.nextElementSibling?.remove()
            return true
        }

    });
    return  result
}
