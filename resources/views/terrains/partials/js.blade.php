@section('custom-scripts')
    @parent
    <script type="text/javascript" src ="{!! asset( 'custom/js/general/FileInput.js') !!}"></script>
    <script type="text/javascript" src ="{!! asset('packages/select2/js/select2.min.js') !!}"></script>
    <script type="text/javascript" src ="{!! asset( 'custom/js/bpackage/Formatters.js') !!}"></script>
    <script type="text/javascript">
        var goo     = {};
        var shapes  = [];
        var mapin   = {};
        var infowindow;
        var map;
        var buyer_shapes = [];
        _config['r_get_byUser']           = "{!! route('terrain.getUserTerrains',['id' => @$user]) !!}";
        _config['r_post_save']            = "{!! route('terrain.save') !!}";
        _config['r_post_edit']            = "{!! route('terrain.edit') !!}";
        _config['r_post_revenue_delete']  = "{!! route('terrain.delete') !!}";
        _config['r_post_delete_photo']    = "{!! route('terrain.delete-photo') !!}";
        _config["page"]                   ="terrain";
        _config["polygonColor"]           = "{!! _color() !!}";
        _config['admin']                  = "{!! @$user !!}";
        _config['isAdmin']                  = ! isNaN(parseInt("{!! @$user !!}"));
        var fileinput = new App.FileInput('#photos', '{!! route('terrain.photo') !!}');

        var combo = new Formatters.Combobox();
        combo.url = "{!! route('terrain.dinamic_locality') !!}";
        combo.request("#id_locatie");
    </script>
    <script type="text/javascript" src ="{!! asset('packages/fileinput/js/fileinput.min.js') !!}"></script>
    <script type="text/javascript" src ="{!! asset( 'packages/inputmask/js/jquery.inputmask.js') !!}"></script>
    <script type="text/javascript" src ="{!! asset( 'packages/inputmask/js/jquery.inputmask.numeric.extensions.js') !!}"></script>
    <script type="text/javascript" src ="{!! asset( 'components/numeral/min/numeral.min.js') !!}"></script>
    <script type="text/javascript" src ="{!! asset( 'custom/js/bpackage/Numeric.js') !!}"></script>
    <script type="text/javascript" src ="{!! asset( 'custom/js/bpackage/GMap.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/TerrainService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/FormService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/TerrainCtrl.js') !!}"></script>
@stop