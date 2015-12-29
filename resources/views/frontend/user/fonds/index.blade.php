@extends('frontend.layouts.master')

@section('content')
<div class="log-fundal">
 <div class="log-pre">
  <div class="panel panel-default">
                
    <div class="col-md-6 col1">
        {!! HTML::image('/img/payment-blue.png', 'a picture') !!}</br>
        <h5>{!! trans('labels.make_pay') !!}</h5>
      <p class="ppre">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in accumsan nibh. Fusce congue justo quis lacus varius, in sollicitudin mi blandit. Donec dolor ex, scelerisque at efficitur id, laoreet quis justo. Duis ut nunc at velit laoreet porttitor. Vivamus interdum, tortor convallis maximus consectetur, tellus dolor congue nulla, eget malesuada magna metus non odio. Phasellus fringilla massa ex, et sagittis nisi rutrum ut.</p>
      <a class="btn btn-confirm" data-target="one" href="{!! route('frontend.profile.fonds.make_pay') !!}">{!! trans('labels.make_pay') !!}</a>
    </div>
    <div class="col-md-6 col2">
       {!! HTML::image('/img/wallet-blue.png', 'a picture') !!}
       <h5>{!! trans('labels.current_balance') !!}</h5> 
        <p class="ppre">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in accumsan nibh. Fusce congue justo quis lacus varius, in sollicitudin mi blandit. Donec dolor ex, scelerisque at efficitur id, laoreet quis justo. Duis ut nunc at velit laoreet porttitor. Vivamus interdum, tortor convallis maximus consectetur, tellus dolor congue nulla, eget malesuada magna metus non odio. Phasellus fringilla massa ex, et sagittis nisi rutrum ut.</p>
        <a class="btn btn-confirm" data-target="five" href="{!! route('frontend.profile.fonds.current_balance') !!}">{!! trans('labels.current_balance') !!}</a>
    </div>
      
      
   
                
  </div>
 </div>
</div>

@stop
@section('custom-scripts')
    <script>
        $(document).ready(function(){
            /*asta se poate rezolva din css, dar eu nu stiu cum :(*/
            $('.preregister li[role=presentation]').on('mouseover', function(){
                console.log(this);
                $(this).siblings('li').removeClass('active');
                $(this).addClass('active');
            })
        })
    </script>
@stop