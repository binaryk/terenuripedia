<div class="lista">
<div class="row">
   <div class="col-md-6">
       {!! $controls['title'] !!}
   </div>
   <div class="col-md-6">
       {!! $controls['id_locatie'] !!}
   </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! $controls['suprafata'] !!}
    </div>
    <div class="col-md-6">
        {!! $controls['id_tip_teren'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! $controls['deschidere'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! $controls['id_tip_caracteristici'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! $controls['pret'] !!}
    </div>
    <div class="col-md-6">
        {!! $controls['telefon'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! $controls['proprietar'] !!}
    </div>
    <div class="col-md-6">
        {!! $controls['negociabil'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! $controls['detalii'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! $controls['front_stradal_1'] !!}
    </div>
    <div class="col-md-6">
        {!! $controls['front_stradal_2'] !!}
    </div>
    <div class="col-md-6">
        {!! $controls['nr_fronturi'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! $controls['latime_drum_acces'] !!}
    </div>
    <div class="col-md-6">
        {!! $controls['constructie_teren'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! $controls['detalii_2'] !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div ng-if="currentTerrain && currentTerrain.photo && currentTerrain.photo != ''">
            <img src="@{{ config.assetBaseUrl + '/' + currentTerrain.photo}}" alt="" width="100px" height="100px">
            <button class="btn btn-default btn-sm" ng-click="currentTerrain.photo = ''">Modifica poza</button>
        </div>
        <div ng-show="currentTerrain && !currentTerrain.photo">
            <input type="hidden" id="inserted_terrain" name="inserted_terrain">
            {!! $controls['photo'] !!}
        </div>

    </div>
</div>
</div>

