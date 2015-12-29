@extends('frontend.layouts.master')
@section('body-attributes')
    ng-controller="BuyerCtrl"
@stop
@section('content')
    @include('buyer.infoPopUp')
    @include('buyer.search')
    @include('buyer.list')
    <div class="col-md-6">
        <div class="map" id="map_in"></div>
    </div>

@stop
@section('custom-styles')
    {!! HTML::script('//maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&.js') !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js') !!}
    <link rel="stylesheet" href="{!! asset('custom/css/list.css') !!}">
    <style>
        #map_in{
            width: 900px;
            height: 600px;
        }
    </style>
@stop

@section('custom-scripts')

    <script>
        _config['r_get_all']    = "{!! route('terrain.all') !!}";
        _config["page"]="search";
        _config["polygonColor"]="#ff0000";
        function getInfo(){
            console.log(_config['current_terrain']);
        }
    </script>
    <script type="text/javascript" src="{!! asset('custom/js/map/cluster.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('custom/js/map/init.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/TerrainService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/BuyerCtrl.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/terrain_coords.js') !!}"></script>

@stop