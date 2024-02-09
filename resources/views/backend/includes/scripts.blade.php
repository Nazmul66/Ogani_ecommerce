<!-- Optional JavaScript -->

<!-- jquery 3.3.1 -->
<script src="{{ asset('backend/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<!-- bootstap bundle js -->
<script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<!-- slimscroll js -->
<script src="{{ asset('backend/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<!-- main js -->
<script src="{{ asset('backend/assets/libs/js/main-js.js') }}"></script>
<!-- chart chartist js -->
<script src="{{ asset('backend/assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
<!-- sparkline js -->
<script src="{{ asset('backend/assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
<!-- morris js -->
<script src="{{ asset('backend/assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/charts/morris-bundle/morris.js') }}"></script>

<!-- chart c3 js -->
<script src="{{ asset('backend/assets/vendor/charts/c3charts/c3.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
<script src="{{ asset('backend/assets/libs/js/dashboard-ecommerce.js') }}"></script>

<!-- toaster Js plugins  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

@yield('scripts')