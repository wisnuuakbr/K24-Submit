<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login - Page </title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="{{ asset('style') }}/assets/images/favicon.ico">

    <!-- Basic Css files -->
    <link href="{{ asset('style') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{ asset('style') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />


</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        @yield('content')

    </div>
    <!-- end wrapper-page -->

    <!-- jQuery  -->
    <script src="{{ asset('style') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('style') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('style') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('style') }}/assets/js/modernizr.min.js"></script>
    <script src="{{ asset('style') }}/assets/js/metisMenu.min.js"></script>
    <script src="{{ asset('style') }}/assets/js/jquery.slimscroll.js"></script>
    <script src="{{ asset('style') }}/assets/js/waves.js"></script>
    <script src="{{ asset('style') }}/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('style') }}/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>


    <!-- App js -->
    <script src="{{ asset('style') }}/assets/js/app.js"></script>

</body>

</html>
