
<!doctype html>
<html lang="en">
 
<head>
   @include('backend.includes.metaTags')
</head>

<body>
    <!-- main wrapper -->
    <div class="dashboard-main-wrapper">

        @include('backend.includes.header')

         @include('backend.includes.sidebar')

        <!-- wrapper  -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">

                    @yield('body-content')

                </div>
            </div>
        </div>
        <!-- end wrapper  -->
    </div>
    <!-- end main wrapper  -->

    @include('backend.includes.scripts')

</body>
 
</html>