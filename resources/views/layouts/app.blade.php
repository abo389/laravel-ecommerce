<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>laravel ecommerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{asset("css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/slick.css")}}">
    <link rel="stylesheet" href="{{asset("css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset('css/notyf.min.css') }}">

    <link rel="stylesheet" href="{{asset("css/spacing.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/responsive.css")}}">

</head>

<body>


@include("layouts.navbar")

{{ $slot }}

@include("layouts.footer")



    <!--jquery library js-->
    <script src="{{ asset("js/jquery-3.7.1.min.js") }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset("js/bootstrap.bundle.min.js") }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset("js/Font-Awesome.js") }}"></script>
    <script src="{{ asset("js/slick.min.js") }}"></script>
    <script src="{{ asset("js/select2.min.js") }}"></script>
    <script src="{{ asset("js/tinymce/tinymce.min.js") }}"></script>
    <script src="{{ asset("js/notyf.min.js") }}"></script>
    <script>var notyf = new Notyf();</script>

    <!--main/custom js-->
    <script src="{{ asset("js/main.js") }}"></script>
    @if(isset($scripts))
    {{ $scripts }}
    @endif
</body>

</html>