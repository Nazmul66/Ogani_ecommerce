 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 @yield('page-titles')

 <!-- Bootstrap CSS -->
 @php $setting = App\Models\Setting::first(); @endphp
 <link rel="icon" type="image/x-icon" href="{{ asset('backend/uploads/website_setting/' . $setting->favicon) }}">
 <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
 <link href="{{ asset('backend/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
 <link rel="stylesheet" href="{{ asset('backend/assets/libs/css/style.css') }}">
 <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
 <link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts/chartist-bundle/chartist.css') }}">
 <link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts/morris-bundle/morris.css') }}">
 <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
 <link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts/c3charts/c3.css') }}">
 <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">

  <!-- toaster css plugin -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Custom css -->
 <link rel="stylesheet" href="{{ asset('backend/assets/libs/css/custom.css') }}">

 @yield('style-css')
