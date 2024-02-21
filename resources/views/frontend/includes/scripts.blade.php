
<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

<!-- toaster Js plugins  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{ asset('frontend/js/main.js') }}"></script>

<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
</script>

<script type="text/javascript">
    @if ( Session::has('message') )

        var type = "{{ Session::get('alert-type') }}";

        switch(type){
            case "info":
               toastr.info("{{ Session::get('message') }}");
            break; 

            case "success":
               toastr.success("{{ Session::get('message') }}");
            break;
            
            case "warning":
               toastr.warning("{{ Session::get('message') }}");
            break;

            case "error":
               toastr.error("{{ Session::get('message') }}");
            break;
        }
    @endif
</script>