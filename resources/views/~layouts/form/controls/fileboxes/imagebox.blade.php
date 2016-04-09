<input id="{!! $name !!}" type="file" multiple />
@section('custom-styles')
    @parent
    @foreach($styles as $k => $style)
        <link rel="stylesheet" href="{!! asset( $style ) !!}">
    @endforeach
@stop
@section('custom-scripts')
    @parent
    @foreach($scripts as $k => $script)
        <script type="text/javascript" src ="{!! asset( $script ) !!}"></script>
    @endforeach
    <script>
        var {!! $name !!} = $("#{!! $name !!}").fileinput({
            'previewClass'    : 'one-file',
            'allowedFileExtensions' : ['jpg', 'png','gif'],
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
            'uploadAsync'     : true,
            'uploadUrl'       : "{!! route($route)!!}",
            uploadExtraData: function() {
                return {
                    @foreach($extraData as $k => $data)
                        {!! $data['key'] !!} : {!! $data['value'] !!},
                    @endforeach
                }
            },
            'fileActionSettings' :
            {
                'removeTitle' : 'Şterge selecţia',
                'uploadTitle' : 'Încarcă fişierul',
                'indicatorNewTitle' : 'Fişierul nu este încărcat'
            }
        });


        function uploadAsincImage(){
            {!! $name !!}.fileinput('upload');
        }
    </script>
@stop