@extends('backend.layouts.master')

@section('page-header')
@endsection

@section('content')
     @include('backend.terrains.list',['terrains' => $terrains])
@endsection

@section('custom-scripts')
@parent
     @include('backend.terrains.script')
@endsection