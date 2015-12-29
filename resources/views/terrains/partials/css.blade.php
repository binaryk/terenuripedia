@section('custom-styles')
    @parent
{!! HTML::script('//maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&.js') !!}
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js') !!}
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/css/select2.min.css" rel="stylesheet" />

<style>
    .kv-fileinput-upload.fileinput-upload-button {
        display: none;
    }
    
    .disabled{
        background: #ccc;
    }
</style>
@stop
