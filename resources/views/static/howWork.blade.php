@extends('frontend.layouts.master')
@section('custom-styles')
    <link rel="stylesheet" href="{!! asset('custom/css/static/about.css') !!}">
@stop
@section('content')

<div class="log-fundal">
    <h1 style="text-align:center;color:#fff;font-weight:100!important">Cum functioneaza</h1>
 <div class="log-pre">
  <div class="panel panel-default">
      
      <p style="margin-bottom:50px;width:600px" class="signup-subtitle"> Ne dorim sa simplificam procesul de tranzactionare a unei proprietati imobiliare, astfel ca am creat o platforma usor de folosit, adresata proprietarilor, bancilor, brokerilor, agentiilor imobiliare, celor care doresc sa achizitioneze un teren, precum si tuturor persoanelor interesate de acest domeniu.</p>
    <div class="clearfix">            
    <div class="cumparator">
      <a class="btn-signup" href="{!! route('howWork.vand') !!}">Cum sa vand un teren ?</a>

    </div>
    <div class="vanzator">
        <a class="btn-signup" href="{!! route('howWork.cumpar') !!}">Cum sa cumpar un teren ?</a>
    </div>
        </div>
     
      
   
                
  </div>
 </div>
</div>    

@stop

