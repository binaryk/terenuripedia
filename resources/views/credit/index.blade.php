@extends('frontend.layouts.master')
@section('custom-styles')
    @parent
    <link rel="stylesheet" href="{!! asset('custom/css/pricing.css') !!}">
@stop
@section('body-attributes')
@stop
@section('content')
    <div class="ui-139">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- Item -->
                    <div class="ui-item">
                        <!-- Heading -->
                        <div class="ui-heading clearfix">
                            <!-- Main Heading -->
                            <h2><a href="#">Creditul dvs</a></h2>
                            <!-- Price -->
                            <h3 class="lblue"><span>RON</span>{!! $user->credit !!}</h3>
                        </div>
                        <!-- Border -->
                        <div class="ui-border bg-lblue"></div>
                        <!-- Paragraph -->
                        <p>Mai jos aveti detalii despre creditul dvs, si metoda de a cumpara mai mult credit.</p>
                        <!-- Listing Starts -->
                        <!-- Heading -->
                        <h4>Posibilitati</h4>
                        <hr/>
                        <div class="row">
                            @if(auth()->user()->hasRole('Saller'))
                                @include('credit.vanzator')
                            @else
                                @include('credit.cumparator')
                            @endif
                        </div>
                        <!-- Listing Ends -->
                        <!-- Button -->
                        <a href="{!! url('profile/fonduri/efectueaza-plata') !!}" class="btn btn-lblue">Cumpara mai mult credit</a> &nbsp;
                        <!-- Contact Us -->
                        <a href="{!! url('despre') !!}" class="btn btn-white">Contact</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('custom-scripts')
@stop