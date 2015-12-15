@extends('frontend.layouts.master')

@section('content')
    <div class="col-md-12 preregister">
        <div class="demo-list-large-screen">
            <ul class="demo-list tabs">
                <li role="presentation" class="active">
                    <a data-target="one" href="{!! url('auth/register/buyer') !!}">
                        <div class="number">1</div>
                        <h5>Cumparator</h5></a>
                </li>
                <li role="presentation">
                    <a data-target="five" href="{!! url('auth/register/saller') !!}">
                        <div class="number">2</div>
                        <h5>Vanzator</h5></a>
                </li>
            </ul>
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