<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Puskesmas Sekura{{ $title ?? '' }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/52c63e43bb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/addition.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.7/datatables.min.css" rel="stylesheet">
    @stack('css')
</head>

<body>
    <div class="d-flex gray-bg overflow-hidden position-relative" style="height: 100vh">
        @include('layouts.admin.sidebar')
        <div id="__main" class="overflow-hidden position-relative vh-100 w-100">
            @include('layouts.admin.navbar', ['title' => $title])
            <main class="overflow-auto w-100" style="height: calc(100vh - 60px)">
                @yield('main')
                <div class="p-4 border-top ">
                    Copyright &copy; {{ date('Y') }} Puskesmas Sekura
                </div>
            </main>
        </div>
    </div>

    <script src="/plugins/jquery/jquery.js"></script>
    <script src="/plugins/bootstrap/js/popper.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/additional.js"></script>
    <script src="/js/admin.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @stack('js')

</body>

</html>
