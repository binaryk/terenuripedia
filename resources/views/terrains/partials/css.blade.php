@section('custom-styles')
    @parent
{!! HTML::script('//maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&.js') !!}
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js') !!}
{!! HTML::style('admin/css/fileinput/fileinput.css') !!}
{!! HTML::style('packages\fileinput\css\fileinput.min.css') !!}

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/css/select2.min.css" rel="stylesheet" />

<style>
    /*.kv-fileinput-upload.fileinput-upload-button {
        display: none;
    }*/
    
    .disabled{
        background: #ccc;
    }

    div.remove{
        -webkit-transition:opacity 500ms ease 250ms;
        -moz-transition:opacity 500ms ease 250ms;
        -o-transition:opacity 500ms ease 250ms;
        transition:opacity 500ms ease 250ms;
    }

    div.photos:hover div.remove{
        opacity: 1;
    }

    div.remove {
        opacity: 0;
        width: 30px;
        height: 30px;
        float: right;
        position: absolute;
        right: 20px;
        background: #E26C76;
        border: 3px solid #ccc;
        border-radius: 100%;
        cursor: pointer;
    }

    div.remove i {
        position: absolute;
        top: 5px;
        right: 6px;
    }
    div.photos {
        width: 150px;
        height: 150px;
        overflow: hidden;
        background: #ccc;
        margin: 10px;
        text-align: center;
        line-height: 150px;
    }
    div.photos img{
        max-width: 100%;
        max-height: 90%;
        vertical-align: middle;
    }
</style>
@stop
