@extends('front.template')
@section('custom-styles')
<style type="text/css">
    html,
    body,
    #map_canvas {
      height: 100%;
      width: 100%;
      margin: 0px;
    }
    
    #map_canvas {
      position: relative;
    }
    
    .angular-google-map-container {
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
    }
  </style> 
@stop

@section('custom-scripts')
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCWUlplRYNo2hLuYIki4KM9NnpEt4gzS28&sensor=false&libraries=drawing"></script>
    <script src='http://maps.googleapis.com/maps/api/js?v=3.17&sensor=false&libraries=places,weather,geometry,visualization,drawing&language=en-US'></script>
@stop

@section('content')
     <div id="map_canvas" ng-controller="MainCtrl">
        <ui-gmap-google-map center="map.center" zoom="map.zoom" options="map.options" events="map.events" control="map.control">
          <ui-gmap-window 
          show              ="map.templatedInfoWindow.show" 
          options           ="map.templatedInfoWindow.options" 
          closeclick        ="map.templatedInfoWindow.closeClick()" 
          templateUrl       ="map.templatedInfoWindow.templateUrl" 
          templateParameter ="map.templatedInfoWindow.templateParameter"
          coords            ="map.templatedInfoWindow.coords"
          >
          </ui-gmap-window>

          <ui-gmap-markers 
          type        ="map.markers.type" 
          typeoptions ="map.markers.typeOptions" 
          idkey       ="'id'" 
          models      ="map.markers.models" 
          coords      ="'self'" 
          fit         ="false" 
          icon        ="'icon'" 
          events      ="map.markersEvents"
          >
          </ui-gmap-markers>
        </ui-gmap-google-map>

        <ui-gmap-drawing-manager
           options="map.drawingManagerOptions" control="map.drawingManagerControl">
        </ui-gmap-drawing-manager>

  </div>
@stop