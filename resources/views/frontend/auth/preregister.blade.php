@extends('frontend.layouts.master')

@section('content')

<div class="log-fundal">
    <h1 style="text-align:center;color:#fff;font-weight:100!important">Commercial Lease Comps On Demand</h1>
    <p class="signup-subtitle mHide">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi scelerisque, diam id ornare dapibus, nisl risus tempor augue, ac aliquam nisl urna vitae felis. Sed vitae nisi placerat nisi mattis faucibus. Cras suscipit rhoncus nunc non sagittis. Vivamus bibendum dolor eu lorem hendrerit, vitae tristique sapien malesuada. </p>
 <div class="log-pre">
  <div class="panel panel-default">
                
    <div class="cumparator">
        {!! HTML::image('/img/user-512.png', 'a picture') !!}</br>
      <p class="ppre">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      <a class="btn-signup" data-target="one" href="{!! url('auth/register/buyer') !!}">Cumparator</a>
    </div>
    <div class="vanzator">
       {!! HTML::image('/img/user-512.png', 'a picture') !!}
        <p class="ppre">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <a class="btn-signup" data-target="five" href="{!! url('auth/register/saller') !!}">Vanzator</a>
    </div>
      
      
   
                
  </div>
 </div>
</div>
                
                
                
@stop
@section('custom-scripts')
    <script>
        $(document).ready(function(){
            /*asta se poate rezolva din css, dar eu nu stiu cum :(*/
            $('footer').hide();
            $('.preregister li[role=presentation]').on('mouseover', function(){
                console.log(this);
                $(this).siblings('li').removeClass('active');
                $(this).addClass('active');
            })
        })
    </script>
@stop