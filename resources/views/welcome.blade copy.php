<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"  type="text/css" href="{{ asset('css/core.css') }}">
    <link rel="stylesheet"  type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet"  type="text/css" href="{{ asset('css/icon-font.min.css') }}">

    <title>Laravel</title>

</head>

<body class="antialiased">
    <div id="app">
        <app></app>
    </div>
</body>
<!-- <script src="{{ mix('js/app.js') }}"></script> -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Styles -->
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

<!-- js -->
<script src="{{ asset('js/core.js') }}"></script>
<script src="{{ asset('js/script.min.js') }}"></script>
<script src="{{ asset('js/process.js') }}"></script>
<script src="{{ asset('js/layout-settings.js') }}"></script>
<!-- <script src="src/plugins/apexcharts/apexcharts.min.js"></script> -->
<!-- <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script> -->
<!-- <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script> -->
<!-- <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script> -->
<script src="{{ asset('js/dashboard3.js') }}"></script>
<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->

</html>