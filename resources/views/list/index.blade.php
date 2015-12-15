@extends('frontend.layouts.master')
@section('custom-styles')
    {!! HTML::script('//maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&.js') !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js') !!}
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/fileinput/fileinput.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/css/select2.min.css" rel="stylesheet" />
    <style>
    </style>
@stop
@section('body-attributes')
ng-controller="TerrainCtrl"
@stop
@section('content')
<div class="navigator-const" ng-cloak>
    @include('list.partials.tabs')
</div>


<div class="map-build">
    <div class="map" id="map_in"></div>
</div>

@stop
@section('custom-scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/js/select2.min.js"></script>
    <script type="text/javascript">
        var goo     = {};
        var shapes  = [];
        var mapin   = {};
        _config['r_get_byUser'] = "{!! route('terrain.getUserTerrains') !!}";
        _config['r_post_save']  = "{!! route('terrain.save') !!}";
        _config['r_post_edit']  = "{!! route('terrain.edit') !!}";
        _config['r_post_revenue_delete']  = "{!! route('terrain.delete') !!}";
        _config["page"]="terrain";

        _config["polygonColor"]= "{!! _color() !!}";
        $(".multiple_class").select2();
        function customizeGoogleMapsButtons() {
            $(".gmnoprint").css("z-index","1000");
            $(".gmnoprint").css("position","absolute");
            $(".gmnoprint").each(function(){
                var newObj = $(this).find("[title='Draw a circle']");
                newObj.parent().addClass("remove");

                // ID the toolbar
                newObj.parent().parent().attr("id", "btnBar");

                // Now remove the Circle button
                $(".remove").remove();
                // ID the Hand button
                newObj = $(this).find("[title='Stop drawing']");
                newObj.attr('id', 'btnStop');
                newObj.addClass('gmapTools');

                // ID the Marker button
                newObj = $(this).find("[title='Add a marker']");
                newObj.attr('id', 'btnMarker');
                newObj.addClass('gmapTools');
                // ID the line button
                // ID the Polygon button
                newObj = $(this).find("[title='Draw a shape']");
                newObj.attr('id', 'btnShape');
                newObj.addClass('gmapTools');
            });
            $(".gmnoprint").hide();
        };
        $('#btnPolygon').click(function(){
           $('#btnShape').click();
        });
        $('#btnHand').click(function(){
            $('#btnStop').click();
        });
        function disableElement(elenentID,value){
            $(elenentID).prop('disabled', value);
        }

    </script>
    <script type="text/javascript" src="{!! asset('custom/js/map/init.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/TerrainService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/FormService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/TerrainCtrl.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/terrain_coords.js') !!}"></script>
    <script type="text/javascript" src = "{{asset( 'packages/fileinput/js/fileinput.min.js') }}"></script>
@stop