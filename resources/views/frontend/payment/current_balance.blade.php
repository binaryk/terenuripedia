@extends('frontend.layouts.master')
@section('body-attributes')
    ng-controller = "PayCtrl"
@stop
@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.current_balance') }}</div>

                <div class="panel-body">
                        @role(config('access.roles.saller'))
                            <h5> Stimate vanzator, mai aveti 0 RON </h5>
                            <h4>Contul este INACTIV, puteti cumpara unul dintre urmatoarele abonamente</h4>
                            @include('frontend.payment.form_subscription')
                        @endauth
                        @role(config('access.roles.buyer'))
                            <h5> Stimate cumparator, mai aveti 15 RON </h5>
                        @endauth
                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection
@section('custom-scripts')
    <script type="text/javascript" src="{{ asset( 'custom/js/angular/controllers/PayCtrl.js') }}"></script>

    <script>
        _config['get_subscriptions'] = "{!! route('frontend.profile.fonds.get_subscriptions') !!}";
        _config['per']                    = @object(App\Models\General::per());
        _config['percents']               = @object(App\Models\General::percent());
    </script>
@stop