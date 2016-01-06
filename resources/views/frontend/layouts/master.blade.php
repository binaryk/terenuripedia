<!doctype html>
<html class="no-js" lang="" ng-app="app">
    @include('frontend.layouts.~head')
    <style>
        #frm_termeni_conditii_inner,
        #frm_confidentialitate_inner,
        #frm_faq_inner
        {
        height: 450px;
        max-height: 450px;
        min-height: 450px;
        overflow: auto;
        font-size: 13px !important;
        padding: 0px 8px;
        }
    </style>
    <body @yield('body-attributes')>
        @include('frontend.layouts.~loading')
        @include('frontend.includes.nav')
        <div class="container-fluid">
            @include('includes.partials.messages')

            @yield('content')

        </div><!-- container -->

        @include('frontend.includes.footer')
        @include('frontend.layouts.~include-js')


        {!!
        \Easy\Form\Modal::make('~layouts.form.modals.modal')
        ->id('frm_condidentialitate')
        ->caption('Politica de confidentialitate')
        ->closable(true)
        ->body('<div id="frm_confidentialitate_inner">' . \View::make('static-pages.content.politica-confidentialitate')->render() . '</div>')
        ->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
        ->out()
        !!}


        {!!
        \Easy\Form\Modal::make('~layouts.form.modals.modal')
        ->id('frm_termeni_conditii')
        ->caption('Termeni si conditii')
        ->closable(true)
        ->body('<div id="frm_termeni_conditii_inner">' . \View::make('static-pages.content.termeni-conditii')->render() . '</div>')
        ->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
        ->out()
        !!}


        {!!
        \Easy\Form\Modal::make('~layouts.form.modals.modal')
        ->id('frm_faq')
        ->caption('Intrebari frecvente')
        ->closable(true)
        ->body('<div id="frm_faq_inner">' . \View::make('static-pages.content.faq')->render() . '</div>')
        ->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
        ->out()
        !!}

        <script>
            $(document).ready( function(){
                var faq     = new CtModal({'id' : '#frm_faq'});
                var termeni_conditii = new CtModal({'id' : '#frm_termeni_conditii'});
                var confidentialitate  = new CtModal({'id' : '#frm_condidentialitate'});
                $('#frm_confidentialitate_open').click(function(e){
                    e.preventDefault();
                    confidentialitate.show();
                });
                $('#frm_termeni_conditii_open').click(function(e){
                    e.preventDefault();
                    termeni_conditii.show();
                });
                $('#frm_faq_open').click(function(e){
                    e.preventDefault();
                    faq.show();
                });
            });
        </script>
    </body>
</html>
