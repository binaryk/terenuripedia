{!! HTML::script('components/jquery/dist/jquery.min.js') !!}
{!! HTML::script('js/vendor/bootstrap.min.js') !!}
{!! HTML::script('components/angular/angular.min.js') !!}
{!! HTML::script('custom/js/angular/~config.js') !!}
{!! HTML::script('components/sweetalert/dist/sweetalert.min.js') !!}
{!! HTML::script('components\bootbox.js\bootbox.min.js') !!}
{!! HTML::script('components/toastr/toastr.min.js') !!}
{!! HTML::script('custom/js/general.js') !!}
{!! HTML::script('components/angular-rangeslider/angular.rangeSlider.js') !!}
{!! HTML::script('custom/js/general/ctmodal.js') !!}

<script>
</script>

@yield('before-scripts-end')
{!! HTML::script(elixir('js/frontend.js')) !!}
@yield('after-scripts-end')
@yield('custom-scripts')
@include('includes.partials.ga')
