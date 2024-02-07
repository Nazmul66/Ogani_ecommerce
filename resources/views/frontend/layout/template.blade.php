
<!DOCTYPE html>
<html lang="en">

<head>
     @include('frontend.includes.metaTag')
</head>

<body>

    @include('frontend.includes.header')


    @yield('body-content')


    @include('frontend.includes.footer')

    <!-- Js Plugins -->
   @include('frontend.includes.scripts')

</body>

</html>