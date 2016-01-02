@extends('frontend.layouts.master')
@section('custom-styles')
@parent
<link rel="stylesheet" href="{!! asset('custom/css/abonamente.css') !!}">
@stop
@section('body-attributes')
    ng-controller = "PayCtrl"
@stop
@section('content')
    <div class="section pricing" id="pricing">
        <div class="section--top">
            <div class="inner">
                <h2>OFERTĂ</h2>
                <div class="product-header">
                    <h3>Free</h3>
                </div>
                <div class="product-header">
                    <h3>Standard</h3>
                </div>
                <div class="product-header highlighted">
                    <h3>Avansat</h3>
                    <span class="popular">Popular</span>
                </div>
            </div>
        </div>
        <div class="section--bottom">
            <div class="inner">
                <div class="product">
                    <div class="product-header mobile-only">
                        <h3>Free</h3>
                    </div>
                    <div class="panel--price">
                        <span class="price">0<span class="small">RON</span><span class="info"></span></span>
                        <a id="frm_detalii_abonament_free_open" href="#">Detalii</a>
                    </div>
                    <div class="features--title"> </div>
                    <div class="panel--feature users">
                        <span class="name">Inregistrare teren</span>
                        <span class="limitations">Da</span>
                    </div>
                    <div class="panel--feature emails">
                        <span class="name">Cumparator vede anunt</span>
                        <span class="limitations">Nelimitat</span>
                    </div>
                    <div class="panel--feature emails">
                        <span class="name">Date contact vizibile</span>
                        <span class="limitations">Nu</span>
                    </div>
                    <div class="panel--feature last">
                            <span class="name">
                            </span>
                        <span class="limitations"> </span>
                    </div>
                    <div class="panel--feature last">
                            <span class="name">
                            </span>
                        <span class="limitations"> </span>
                    </div>
                    <div class="yearly--price">
                        <span class="title"><strong></strong></span>
                        <span class="price">0 RON</span>
                    </div>
                </div>
                <div class="product">
                    <div class="product-header mobile-only">
                        <h3>Standard</h3>
                    </div>
                    <div class="panel--price">
                        <span class="price">36<span class="small">RON</span><span class="info">/ LUNA</span></span>
                        <span class="targets">432<span class="info">RON/AN</span></span>
                        <a id="frm_detalii_abonament_standard_open" href="#">Detalii</a>
                    </div>
                    <div class="features--title"> </div>
                    <div class="panel--feature users">
                            <span class="name">Inregistrare teren
                            </span>
                        <span class="limitations">Da</span>
                    </div>
                    <div class="panel--feature emails">
                        <span class="name">Cumparator vede anunt</span>
                        <span class="limitations">Nelimitat</span>
                    </div>
                    <div class="panel--feature last">
                            <span class="name">Date contact vizibile
                            </span>
                        <span class="limitations">Primul anunt</span>
                    </div>
                    <div class="panel--feature last">
                            <span class="name">Alege tip plata
                            </span>
                        <span class="limitations">
                                <select name="per" id="per">
                                    <option value="1">Luna</option>
                                    <option value="2">An</option>
                                </select>
                        </span>
                    </div>
                    <div class="panel--feature last">
                            <span class="name">
                            </span>
                        <span class="limitations"> </span>
                    </div>
                    <div class="yearly--price">
                        <span class="title"><strong>Anual sau lunar</strong></span>
                        <span class="price">432/36 RON</span>
                    </div>
                </div>
                <div class="product highlighted">
                    <div class="product-header highlighted mobile-only">
                        <h3>Avansat</h3>
                        <span class="popular">Popular</span>
                    </div>
                    <div class="panel--price">
                        <span class="price">36<span class="small">
                        </span><span class="info">/LUNA</span></span>
                        <a id="frm_detalii_abonament_avansat_open" href="#">Detalii</a>
                    </div>
                    <div class="features--title"> </div>
                    <div class="panel--feature users">
                            <span class="name">Inregistrare teren
                            </span>
                        <span class="limitations">Da</span>
                    </div>
                    <div class="panel--feature emails">
                        <span class="name">Cumparator vede anunt</span>
                        <span class="limitations">Nelimitat</span>
                    </div>
                    <div class="panel--feature last">
                            <span class="name">Date contact vizibile
                            </span>
                        <span class="limitations">Primul anunt</span>
                    </div>
                    <div class="panel--feature last">
                            <span class="name">Alege tip plata
                            </span>
                        <span class="limitations">
                                <select name="per" id="per">
                                    <option value="1">Luna</option>
                                    <option value="2">An</option>
                                </select>
                        </span>
                    </div>
                    <div class="yearly--price">
                        <span class="title"><strong>Lunar</strong></span>
                        <span class="price">2000 RON</span>
                    </div>
                </div>
                <div class="text-center">
                        @role(config('access.roles.saller'))
                        @include('frontend.payment.form_subscription')
                        @endauth
                        @role(config('access.roles.buyer'))
                        <h5> Stimate cumparator, mai aveti 15 RON </h5>
                        @endauth
                    </div><!--panel body-->
                </div>
            <div class="support">
                <p><strong>Doriți mai multe informații?</strong> Contactați-ne la <a href="mailto:office@terenuripedia.ro"> office@terenuripedia.ro</a></p>
            </div>

        </div>
        </div>
    </div>
    {!!
    \Easy\Form\Modal::make('~layouts.form.modals.modal')
    ->id('frm_detalii_abonament_avansat')
    ->caption('Abonament avansat')
    ->closable(true)
    ->body('<div id="frm_detalii_abonament_avansat_inner">' . \View::make('static-pages.content.abonament_avasat')->render() . '</div>')
    ->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
    ->out()
    !!}


    {!!
    \Easy\Form\Modal::make('~layouts.form.modals.modal')
    ->id('frm_detalii_abonament_standard')
    ->caption('Abonament Standard')
    ->closable(true)
    ->body('<div id="frm_detalii_abonament_standard_inner">' . \View::make('static-pages.content.abonament_standard')->render() . '</div>')
    ->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
    ->out()
    !!}


    {!!
    \Easy\Form\Modal::make('~layouts.form.modals.modal')
    ->id('frm_detalii_abonament_free')
    ->caption('Abonament Free')
    ->closable(true)
    ->body('<div id="frm_detalii_abonament_free_inner">' . \View::make('static-pages.content.abonament_free')->render() . '</div>')
    ->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
    ->out()
    !!}
@endsection
@section('custom-scripts')
    <script type="text/javascript" src="{{ asset( 'custom/js/angular/controllers/PayCtrl.js') }}"></script>
    <script type="text/javascript" src="{{ asset( 'custom/js/general/ctmodal.js') }}"></script>

    <script>
        _config['get_subscriptions'] = "{!! route('frontend.profile.fonds.get_subscriptions') !!}";
        _config['per']                    = @object(App\Models\General::per());
        _config['percents']               = @object(App\Models\General::percent());

        $(document).ready( function(){
            var abonament_free     = new CtModal({'id' : '#frm_detalii_abonament_free'});
            var abonament_standard = new CtModal({'id' : '#frm_detalii_abonament_standard'});
            var abonament_avansat  = new CtModal({'id' : '#frm_detalii_abonament_avansat'});
            $('#frm_detalii_abonament_avansat_open').click(function(e){
                e.preventDefault();
                abonament_avansat.show();
            });
            $('#frm_detalii_abonament_standard_open').click(function(e){
                e.preventDefault();
                abonament_standard.show();
            });
            $('#frm_detalii_abonament_free_open').click(function(e){
                e.preventDefault();
                abonament_free.show();
            });
        });

    </script>
@stop