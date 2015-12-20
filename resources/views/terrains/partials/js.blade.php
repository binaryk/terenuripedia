@section('custom-scripts')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/js/select2.min.js"></script>
    <script type="text/javascript" src ="{{asset( 'packages/inputmask/js/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src ="{{asset( 'packages/inputmask/js/jquery.inputmask.numeric.extensions.js') }}"></script>
    <script type="text/javascript" src ="{{asset( 'custom/js/Numeric.js') }}"></script>
    <script type="text/javascript" src ="{{asset( 'components/numeral/min/numeral.min.js') }}"></script>
    <script type="text/javascript" src ="{{asset( 'packages\fileinput\js\fileinput.min.js') }}"></script>
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
        function customizeGoogleMapsButtons() {
            $(".gmnoprint").css("z-index","1000");
            $(".gmnoprint").css("position","absolute");
            $(".gmnoprint").each(function(){
                var newObj = $(this).find("[title='Draw a circle']");
                newObj.parent().addClass("remove");

                // ID the toolbar
                newObj.parent().parent().attr("id", "btnBar");

                // Now remove the Circle button
                $(".remove").remove();
                // ID the Hand button
                newObj = $(this).find("[title='Stop drawing']");
                newObj.attr('id', 'btnStop');
                newObj.addClass('gmapTools');

                // ID the Marker button
                newObj = $(this).find("[title='Add a marker']");
                newObj.attr('id', 'btnMarker');
                newObj.addClass('gmapTools');
                // ID the line button
                // ID the Polygon button
                newObj = $(this).find("[title='Draw a shape']");
                newObj.attr('id', 'btnShape');
                newObj.addClass('gmapTools');
            });
            $(".gmnoprint").hide();
        };
        $('#btnPolygon').click(function(){
            $('#btnShape').click();
        });
        $('#btnHand').click(function(){
            $('#btnStop').click();
        });
        function disableElement(elenentID,value){
            $(elenentID).prop('disabled', value);
        }

        var upload_document = $("#file-document").fileinput({
            'previewClass'    : 'one-file',
            'previewSettings' :
            {
                image:  {width: "auto", height: "160px"},
                html:   {width: "auto", height: "160px"},
                text:   {width: "auto", height: "160px"},
                video:  {width: "auto", height: "160px"},
                audio:  {width: "auto", height: "80px"},
                flash:  {width: "auto", height: "160px"},
                object: {width: "auto", height: "160px"},
                other:  {width: "auto", height: "160px"}
            },
            'dropZoneEnabled' : false,
            'browseLabel'     : 'Alege fişier',
            'removeLabel'     : 'Şterge selecţia',
            'uploadLabel'     : 'Încarcă fişierul',
            'uploadAsync'     : false,
            'uploadUrl'       : "{{ route('terrain.photo')}}",
            uploadExtraData: function() {
                return {
                    terrain_id: $('#inserted_terrain').val(),
                }
            },
            'fileActionSettings' :
            {
                'removeTitle' : 'Şterge selecţia',
                'uploadTitle' : 'Încarcă fişierul',
                'indicatorNewTitle' : 'Fişierul nu este încărcat'
            }
        });

        upload_document.on('fileuploaded', function(event, data, previewId, index){
            $("#file-document").fileinput('clear');
            console.log(data)
            document.modificari = true;
            var file_name = data.files[0].name;
            var extention = file_name.split('.')[1];
            var file_name = file_name.split('.')[0];
            $('#inserted_terrain').val(-1);
            var MyDate = new Date();
            var MyDateString;
            console.log(MyDateString);
            MyDateString =  MyDate.getFullYear() + '-' + ('0' + (MyDate.getMonth()+1)).slice(-2)   + '-' + ('0' + MyDate.getDate()).slice(-2) ;
        });

    </script>
    <script type="text/javascript" src="{!! asset('custom/js/map/init.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/TerrainService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/services/FormService.js') !!}"></script>
    <script type="text/javascript" src="{!! asset( 'custom/js/angular/controllers/TerrainCtrl.js') !!}"></script>
    <script type="text/javascript" src ="{{asset( 'packages/fileinput/js/fileinput.min.js') }}"></script>
@stop