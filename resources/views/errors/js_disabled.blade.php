<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link rel="apple-touch-icon" href="{{asset('dsaerp_images/default_images/title_logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('dsaerp_images/default_images/title_logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/themes/semi-dark-layout.css')}}">
</head>

<body class="contanier-fluid">
    <div class="text-center pt-lg-5 " >
        <h1 class="text-primary"><u>Alert ! You Have Disabled The Javascript From Browser</u></h1>
        <h2 class="text-success pt-5">Please Allow Javascript From Web Browser To Experience The Smooth App</h2>
        <br><br>
        <h3><a class="text-info pt-5" href="https://www.enablejavascript.io/en"><b>Click Here To See How to Enabled</b></a></h3>
        <br><br>
        {{-- <img src="{{asset('witnovus_theme/app-assets/images/pages/login.png')}}" alt="branding logo"> --}}
    </div>
    <script>
        window.location.href = "{{route('main_dashboard')}}";
    </script>
</body>
</html>
