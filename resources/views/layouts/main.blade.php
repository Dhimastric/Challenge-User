<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('metas')

    <title>Challenge</title>

    @include('layouts.partials.link')
</head>
@stack('styles')

<style type="text/css">
    .gradient-custom {
        background: #6a11cb;
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
</style>

<body class="gradient-custom">
    <div class="container" style="margin-top: 50px">
        <div class="row">
            @include('layouts.partials.nav')

            @yield('content')

            @include('layouts.partials.script')
            @stack('scripts')
        </div>
    </div>
</body>

</html>
