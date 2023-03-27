<!DOCTYPE html>

@if (\Request::is('rtl'))
    <html dir="rtl" lang="ar">
@else
    <html lang="en">
@endif

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @if (env('IS_DEMO')) --}}
    {{-- <x-demo-metas></x-demo-metas> --}}
    {{-- @endif --}}

    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <title>
        Consultile CRM
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="appstyle" href="/assets/css/core.css?v=1.0.3" rel="stylesheet" />
    <link id="pagestyle" href="/assets/css/style.css?v=1.0.5" rel="stylesheet" />
    <link href="/assets/css/summernote.min.css" rel="stylesheet">
    <script src="/assets/js/plugins/jquery-3.5.1.min.js"></script>
    <script src="/assets/js/core/bootstrap.bundle.min.js"></script>
    {{-- <script src="/assets/js/plugins/bootstrap-autocomplete.min.js"></script> --}}
    <script src="/assets/js/init.js?v=1.0.5"></script>
    <script type="module">
        import Autocomplete from "/assets/js/plugins/bootstrap-autocomplete.min.js";
        const opts = {
          onSelectItem: console.log,
        };

        let src = [ ];
        fetch('/countries').then((response) => response.json())
      .then((data) =>src = data).then(re =>{
        Autocomplete.init("input.autocompletecountries", {
          items: src,
          valueField: "label",
          labelField: "title",
          highlightTyped: true,
          onSelectItem: (e)=>{console.log(e)},
        });}
      );
        fetch('/companies').then((response) => response.json())
      .then((data) =>src = data).then(re =>{
        Autocomplete.init("input.autocomplete", {
          items: src,
          valueField: "label",
          labelField: "title",
          highlightTyped: true,
          onSelectItem: (e)=>{console.log(e)},
        });}
      );


        const formsubmit = document.getElementById('contact-form')
        formsubmit?.addEventListener('submit', handleSubmit)
        async function handleSubmit(e) {
            let err = 0
            let span = document.createElement('span');
            const form = e.target
            e.preventDefault()
            if(form.email.value.trim() =='' && form.work_phone.value.trim() =='' && form.personal_phone.value.trim() =='' && form.first_name.value.trim() =='' && form.last_name.value.trim() ==''  ){
                alert('You can\'t save with all importaant fields empty')
                return false
            }
            form.submitBtn.disabled = true
            let validationFileds = [form.email, form.work_phone, form.personal_phone]
            for (const ele  of validationFileds) {
                const { name, value } = ele
                if (ele.value.trim() == '' || ele.value.trim() == ele.dataset.default.trim())
                continue
                    await  post("/check-duplicate", { name, value } )
                    .then(json=>{

                        ele.classList.remove('border-danger')
                        ele?.nextElementSibling?.remove()
                        if (json?.id) {
                            ele.classList.add('border-danger')
                            ele.parentNode.insertBefore(span, ele.nextSibling);
                            span.innerHTML = `<p class="text-danger text-xs mt-2">Its already exist under ${json?.first_name} ${json?.last_name}, click <a href="/contacts/${json?.id}/edit">here</a> to update it.</a></p>`
                            err++
                        }
                    })
            }
            // e.preventDefault()
            let company = form.company
            company.classList.remove('border-danger')
            // company?.nextElementSibling?.remove()
            if(!src.includes(form.company.value)) {
                company.classList.add('border-danger')
                // company.parentNode.insertBefore(span, company.nextSibling)
                if(!confirm("Campany name not found.\n Do you want add it as a new one")){
                    form.submitBtn.disabled = false
                    return false
                }
                // span.innerHTML = `<p class="text-danger text-xs mt-2">Campany name not found</p>`
            }
            console.log(err)
            if(err == 0)
                form.submit();
            else
                form.submitBtn.disabled = false


        }

      </script>


</head>

<body
    class="g-sidenav-show  bg-gray-100 {{ \Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '') }} ">
    @auth
        @yield('auth')
    @endauth
    @guest
        @yield('guest')
    @endguest

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
            <p class="m-0">{{ session('success') }}</p>
        </div>
    @endif
    <!--   Core JS Files   -->



    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/fullcalendar.min.js"></script>
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    {{-- <script src="/assets/js/core.min.js?v=1.0.4"></script> --}}
    <script src="/assets/js/plugins/summernote.min.js"></script>
    <script src="/assets/js/plugins/moment.min.js"></script>
    <script src="/assets/js/main.js?v=1.0.6"></script>

    @stack('rtl')
    @stack('dashboard')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('e26f3579c24775647413', {
            cluster: 'mt1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            console.log(data)
            let doc = new DOMParser().parseFromString(
                `<div class="toast fade p-2 mt-2 bg-gradient-success hide" role="alert" aria-live="assertive" id="notifyMini"
                aria-atomic="true">
                <div class="toast-header bg-transparent border-0 d-flex">
                    <i class="${data.message.icon} text-white me-2"></i>
                    <span class="me-auto text-white font-weight-bold toast-title">Campaign ${data.message.title} </span>
                    <small class="text-white"></small>
                    <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"
                        aria-hidden="true"></i>
                </div>
                <hr class="horizontal light m-0">
                <div class="toast-body text-white d-flex">
                    ${data.message.body}
                </div>
            </div>`, 'text/html')

            let toastEle = doc.body.querySelector('.toast');
            console.log(toastEle)
            document.getElementById('notifyBase').appendChild(toastEle)
            let toast = new bootstrap.Toast(toastEle)
            toast.show()
        });
    </script>

</body>

</html>
