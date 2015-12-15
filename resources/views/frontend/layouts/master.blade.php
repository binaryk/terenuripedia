<!doctype html>
<html class="no-js" lang="" ng-app="app">
    @include('frontend.layouts.~head')
    <body @yield('body-attributes')>
        @include('frontend.includes.nav')
        <div class="container-fluid">
            @include('includes.partials.messages')

            @yield('content')

        </div><!-- container -->
        @include('frontend.layouts.~include-js')
    </body>
</html>
