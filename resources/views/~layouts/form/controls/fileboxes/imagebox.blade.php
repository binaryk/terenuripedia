<input id="{!! $name !!}" type="file" />
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

        {!! $name !!}.on('fileuploaded', function(event, data, previewId, index){
            $("#{!! $name !!}").fileinput('clear');
            console.log(data)
            document.modificari = true;
            var file_name = data.files[0].name;
            var extention = file_name.split('.')[1];
            var file_name = file_name.split('.')[0];
            @foreach($extraData as $k => $data)
            {!! $data['clean'] !!};
            @endforeach
            var MyDate = new Date();
            var MyDateString;
            console.log(MyDateString);
            MyDateString =  MyDate.getFullYear() + '-' + ('0' + (MyDate.getMonth()+1)).slice(-2)   + '-' + ('0' + MyDate.getDate()).slice(-2) ;
        });

        function uploadAsincImage(){
            {!! $name !!}.fileinput('upload');
        }
    </script>
@stop