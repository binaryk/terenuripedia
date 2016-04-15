<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Default Description')">
    <meta name="author" content="@yield('author', 'binaryk.net')">
    <link href="{!! asset('img/favicon.ico') !!}" rel="icon" type="image/x-icon" />
    @yield('meta')
    @yield('before-styles-end')
    {!! HTML::style(elixir('css/frontend.css')) !!}
    {!! HTML::style('components/sweetalert/dist/sweetalert.css') !!}
    {!! HTML::style('components/toastr/toastr.css')!!}
    {!! HTML::style('css/auth/style.css') !!}
    {!! HTML::style('custom/css/main.css') !!}
    {!! HTML::style('components/angular-rangeslider/angular.rangeSlider.css') !!}
    {!! HTML::style('components\bootstrap\dist\css\bootstrap.min.css') !!}

    @yield('after-styles-end')
    <style>
        div[load]{
            display: none;
        }
    </style>

    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    {!! HTML::script("js/vendor/modernizr-2.8.3.min.js") !!}
    <script>
        var _config = {
            assetBaseUrl : "{{ asset('') }}",
            baseUrl : "{{ url('/') }}"
        };
    </script>
    @yield('custom-styles')
</head>