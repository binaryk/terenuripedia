@extends('frontend.layouts.master')
@section('custom-styles')
    <link rel="stylesheet" href="{!! asset('custom/css/static/about.css') !!}">
@stop
@section('content')

    <div class="container">
        <pre>
            Ne dorim sa simplificam procesul de tranzactionare a unei proprietati imobiliare, astfel ca am creat o platforma usor de folosit, adresata proprietarilor, bancilor, brokerilor, agentiilor imobiliare, celor care doresc sa achizitioneze un teren, precum si tuturor persoanelor interesate de acest domeniu.
        </pre>
        <a href="{!! route('howWork.vand') !!}">Cum sa vand un teren ?</a>
        <a href="{!! route('howWork.cumpar') !!}">Cum sa cumpar un teren ?</a>
    </div>

@stop

