@extends('front.template')
@include('list.partials.header')
@section('body-attributes')
    ng-controller="TerrainSearchCtrl"
@stop
@section('content')
    @include('terrain.infoPopUp')
    <div id="search_div" class="col-md-3">
        <input type="button" value="Cautare noua" class="btn-primary btn-lg col-md-12"/>
        <div class="col-md-12">
            <label class="control-label">Titlu</label>
            <input type="text" class="form-control" ng-model="f_title">
        </div>
        <div class="col-md-12">
            <label class="control-label">Preț minim</label>
            <input type="text" class="form-control" ng-model="f_pret_min">
        </div>
        <div class="col-md-12">
            <label class="control-label">Preț maxim</label>
            <input type="text" class="form-control" ng-model="f_pret_max">
        </div>
        <div class="col-md-12">
            {!!
                 \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                            ->name('id_locatie')
                            ->caption('Locație')
                               ->ng_model('f_locatie')
                            ->class('form-control data-source input-group form-select init-on-update-delete')
                            ->controlsource('id_locatie')
                            ->controltype('combobox')
                            ->options(\App\Terrain::locatie())
                            ->out()
                !!}
        </div>
        {{--<div class="col-md-12">--}}
            {{--<label>--}}
            {{--<input type="checkbox">Tipul de teren--}}
            {{--</label>--}}
        {{--</div>--}}
        {{--<div class="col-md-12">--}}
            {{--<label class="control-label">Suprafata minima</label>--}}
            {{--<input type="text" class="form-control" ng-model="f_suprafata_min">--}}
        {{--</div>--}}
        {{--<div class="col-md-12">--}}
            {{--<label class="control-label">Suprafata maxima</label>--}}
            {{--<input type="text" class="form-control" ng-model="f_suprafata_max">--}}
        {{--</div>--}}
        {{--<div class="col-md-12">--}}
            {{--<label>--}}
            {{--<input type="checkbox">Canalizare--}}
            {{--</label>--}}
        {{--</div>--}}
    </div>
    <div class="col-md-3">
        <div class="col-md-12" style="margin-top: 30px;">
            <table class="table table-bordered" ng-if="searchTerrains.length > 0" style="background: white;">
                <thead>
                <tr>
                    <th>Nume</th>
                    <th>Preț</th>
                    <th>Telefon</th>
                    <th>Detalii</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="terrain in searchTerrains
                              |filter: { title: f_title, pret: f_pret, id_locatie: f_locatie }
                              |filter:byRange('pret', f_pret_min, f_pret_max)"
                              {{--|filter:byRange('suprafata', f_suprafata_min, f_pret_max)"--}}

                    ng-click="click(terrain)">
                    <td style="cursor: pointer;" ><i class="fa fa-info" title="Click pentru a vedea mai multe detalii"></i> @{{ terrain.title }}</td>
                    <td>@{{ terrain.pret }}</td>
                    <td>@{{ terrain.telefon }}</td>
                    <td>@{{ terrain.detalii }}</td>
                </tr>
                </tbody>
            </table>

            <div class="alert alert-info" role="info" ng-if="terrains.length == 0">
                <h6>
                    Încă nu sunt terenuri salvate!
                </h6>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="map" id="map_in"></div>
    </div>

@stop
@section('custom-styles')
    {!! HTML::script('//maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&.js') !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js') !!}
@stop

@section('custom-scripts')

    <script>
        var _config = {};
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
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/TerrainSearchCtrl.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/terrain_coords.js') !!}"></script>
@stop