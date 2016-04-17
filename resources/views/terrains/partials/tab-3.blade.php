<div class="lista-label">
<div class="row">
   <div class="col-md-6">
       <input id="user_owner" name="user_owner" type="hidden" value="{!! @$user !!}">
       {!! $controls['title'] !!}
   </div>
   <div class="col-md-6">
       {!! $controls['id_locatie'] !!}
   </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! $controls['suprafata'] !!}
        <span class="input-addon">mp</span>
    </div>
    <div class="col-md-6">
        {!! $controls['id_tip_teren'] !!}
    </div>
</div>
</div>  


<div class="lista-label-lung">
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
</div>    

<div class="lista-label content-tip">
<div class="row">
    <div class="col-md-6 pret">
        {!! $controls['pret'] !!}
        <span class="input-addon">euro</span>
    </div>
    <div class="col-md-6">
        {!! $controls['telefon'] !!}
        <div class="icon-phone"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! $controls['proprietar'] !!}
        <div class="icon-proprietar"></div>
    </div>
    <div class="col-md-6">
     <div class="form-group">    
        <label class="control-label" for="deschidere">Negociabil</label>
        <div id="container_tranzactie" class="content-tip-tranzactie">
            <input type="hidden" name="tranzactie" value="">
            <input type="radio" id="de_vanzare" value="de_vanzare" name="tranzactie">
            <label class="col-xs-6 text-center btn-tranzactie" for="de_vanzare"><span>Da</span></label>
            <input type="radio" id="de_inchiriat" value="de_inchiriat" name="tranzactie">
            <label class="col-xs-6 text-center btn-tranzactie last" for="de_inchiriat"><span>Nu</span></label>
        </div>
    </div>     
        
    </div>
</div>
</div>    
    
<div class="row">
    <div class="col-md-12">
        {!! $controls['detalii'] !!}
    </div>
</div>
<div class="row content-tip">
    <div class="col-md-12">
        <div id="container_front" class="content-tip-tranzactie">
            <input type="radio" id="de_vanzare2" value="de_vanzare" name="tranzactie2">
            <label class="col-xs-6 text-center btn-tranzactie" for="de_vanzare2"><span>Are front stradal</span></label>
            <input type="radio" id="de_inchiriat" value="de_inchiriat2" name="tranzactie">
            <label class="col-xs-6 text-center btn-tranzactie last" for="de_inchiriat2"><span>Nu are front stradal</span></label>
        </div>
        
    </div>
</div>
<div class="lista-label">
    <div class="row">
        <div class="col-md-6">
            {!! $controls['nr_fronturi'] !!}
        </div>
        <div class="col-md-6">
            {!! $controls['constructie_teren'] !!}
        </div>
    </div>
</div>
<div class="col-md-12 clearfix" ng-if="ADD">
    {!! $controls['photo'] !!}
    <input type="hidden" id="inserted_terrain">
</div>
<br>