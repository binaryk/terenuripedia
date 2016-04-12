@extends('frontend.layouts.master')
@section('body-attributes')
    ng-controller="BuyerCtrl"
@stop
@section('content')
    @include('buyer.search')
    @include('buyer.list')
    <div class="guest_map">
        <div class="map" id="map_in"></div>
    </div>
@stop
@section('custom-styles')
    {!! HTML::script('//maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&.js') !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js') !!}
    <link rel="stylesheet" href="{!! asset('custom/css/list.css') !!}">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
@stop

@section('custom-scripts')
    <script>                
        var goo     = {};
        var shapes  = [];
        var mapin   = {};

        _config['r_get_all']    = "{!! route('terrain.all') !!}";
        _config["r_post_info"]  = "{!! route('terrain.info') !!}";
        _config["page"]="search";
        _config["polygonColor"]="#ff0000";
        function getInfo(){
            console.log(_config['current_terrain']);    
        }
    </script>

    <script type="text/javascript" src="{!! asset('custom/js/map/cluster.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('custom/js/bpackage/GMap.js') !!}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
    <link href="{!! asset( 'custom/css/slick.css') !!}" rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/TerrainService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/BuyerCtrl.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/terrain_coords.js') !!}"></script>

    <script> 
        var init_carouser = function(){
            console.log('init carousel');
            return jQuery('.carousel').slick({
  infinite: true,
  speed: 500,
  fade: true,
  cssEase: 'linear',
  nextArrow: '<i class="fa fa-arrow-right"></i>',
  prevArrow: '<i class="fa fa-arrow-left"></i>',               
        });
    }
    </script>

@stop