<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>{{ $title ?? 'Puskesmas Sekura' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="/plugins/icofont/icofont.min.css">
    <script src="https://kit.fontawesome.com/52c63e43bb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/addition.css">
    @stack('css')
</head>

<body id="top">
    @include('layouts.navbar')
    @yield('main')
    @include('layouts.footer')
    <script src="/plugins/jquery/jquery.js"></script>
    <script src="/plugins/bootstrap/js/popper.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/additional.js"></script>
    @include('faq')
    @stack('js')
</body>

</html>
