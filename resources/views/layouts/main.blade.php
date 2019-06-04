<!DOCTYPE html>
<html>
<head>
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/date/bootstrap-datetimepicker.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/date/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/date/datepicker.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/date/jquery-ui.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/date/jquery-ui.theme.min.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')
    </div>
</body>

<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/date/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/date/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/date/jquery-ui.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>

@yield('js')
</html>

