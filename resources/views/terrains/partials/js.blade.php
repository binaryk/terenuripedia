@section('custom-scripts')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/js/select2.min.js"></script>
    <script type="text/javascript" src ="{{asset( 'packages/inputmask/js/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src ="{{asset( 'packages/inputmask/js/jquery.inputmask.numeric.extensions.js') }}"></script>
    <script type="text/javascript" src ="{{asset( 'custom/js/Numeric.js') }}"></script>
    <script type="text/javascript" src ="{{asset( 'components/numeral/min/numeral.min.js') }}"></script>
    <script type="text/javascript">
        (new Numeric).formatInputs();
        var goo     = {};
        var shapes  = [];
        var mapin   = {};
        _config['r_get_byUser']           = "{!! route('terrain.getUserTerrains') !!}";
        _config['r_post_save']            = "{!! route('terrain.save') !!}";
        _config['r_post_edit']            = "{!! route('terrain.edit') !!}";
        _config['r_post_revenue_delete']  = "{!! route('terrain.delete') !!}";
        _config["page"]                   ="terrain";
        _config["polygonColor"]           = "{!! _color() !!}";
        $(".multiple_class, #id_locatie, #id_tip_teren, #negociabil").select2();
        $('#btnPolygon').click(function(){
            drawman.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
        });
        $('#btnHand').click(function(){
            drawman.setDrawingMode(google.maps.drawing.OverlayType.POINTER_MOUSE);
        });
        function disableElement(elenentID,value){
            $(elenentID).prop('disabled', value);
            if(value){
                $(elenentID).addClass('disabled')
            }else{
                $(elenentID).removeClass('disabled')
            }

        }



    </script>
    <script type="text/javascript" src="{!! asset('custom/js/map/init.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/TerrainService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/FormService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/TerrainCtrl.js') !!}"></script>
@stop