@extends('frontend.layouts.master')
@include('terrains.partials.css')
@section('body-attributes')
ng-controller="TerrainCtrl"
@stop
@section('content')
<div class="navigator-const" ng-cloak>
    @include('terrains.partials.tabs')
</div>


<div class="map-build">
    <div class="map" id="map_in"></div>
</div>

@stop

@include('terrains.partials.js')