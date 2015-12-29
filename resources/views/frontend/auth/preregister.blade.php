@extends('frontend.layouts.master')

@section('content')
<div class="log-fundal">
 <div class="log-pre">
  <div class="panel panel-default">
                
    <div class="col-md-6 col1">
        {!! HTML::image('/img/profile-blue.png', 'a picture') !!}</br>
        <h5>Cumparator</h5>
      <p class="ppre">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in accumsan nibh. Fusce congue justo quis lacus varius, in sollicitudin mi blandit. Donec dolor ex, scelerisque at efficitur id, laoreet quis justo. Duis ut nunc at velit laoreet porttitor. Vivamus interdum, tortor convallis maximus consectetur, tellus dolor congue nulla, eget malesuada magna metus non odio. Phasellus fringilla massa ex, et sagittis nisi rutrum ut.</p>
      <a class="btn btn-confirm" data-target="one" href="{!! url('auth/register/buyer') !!}">Inregistrare</a>
    </div>
    <div class="col-md-6 col2">
       {!! HTML::image('/img/profile-blue.png', 'a picture') !!}
       <h5>Vanzator</h5> 
        <p class="ppre">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in accumsan nibh. Fusce congue justo quis lacus varius, in sollicitudin mi blandit. Donec dolor ex, scelerisque at efficitur id, laoreet quis justo. Duis ut nunc at velit laoreet porttitor. Vivamus interdum, tortor convallis maximus consectetur, tellus dolor congue nulla, eget malesuada magna metus non odio. Phasellus fringilla massa ex, et sagittis nisi rutrum ut.</p>
        <a class="btn btn-confirm" data-target="five" href="{!! url('auth/register/saller') !!}">Inregistrare</a>
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