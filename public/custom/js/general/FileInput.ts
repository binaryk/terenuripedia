module App{
    declare var $;

    export class FileInput{
        public object: any;
        public inited = false;
        public terrain_id = 0;
        constructor(public input_selector : string, public upload_route : string, public delete_route?:string){
        }

        init(terrain_id, callback){
            const _that = this;
            console.log('it', terrain_id);
            _that.terrain_id = terrain_id;
            if(_that.object) {
                _that.object.fileinput('reset')
            };
            _that.object =  $(_that.input_selector).fileinput({
                'showPreview' : true,
                'allowedFileExtensions' : ['jpg', 'png','gif'],
                'showUpload':true,
                'dropZoneEnabled' : false,
                'browseLabel'     : 'Alege fişier',
                'removeLabel'     : 'Şterge selecţia',
                'uploadLabel'     : 'Încarcă fişierul',

                'uploadAsync'     : true,
                'uploadUrl'       : _that.upload_route,
                'uploadExtraData': function() {
                    console.log('jos',_that.terrain_id);
                    return {
                        terrain_id : _that.terrain_id
                    }
                },
                'fileActionSettings' :
                {
                    'removeTitle' : 'Şterge selecţia',
                    'uploadTitle' : 'Încarcă fişierul',
                    'indicatorNewTitle' : 'Fişierul nu este încărcat'
                },
                'maxFileCount': 10
                });

                if(! this.inited){
                    _that.object.on('fileuploaded', callback);
                }
                this.inited = true;
        }

        onFileUploaded = (event, data, previewId, index) => {
            console.log(data.response);
            $('#photo').attr('src',data.response.path);
            $(this.input_selector).fileinput('clear');
        }

        deleteFile = (id:number) => {
            const _that = this;
            $.ajax({
                url: _that.delete_route,
                type: 'post',
                dataType: 'json',
                data: {'id': id},
                success: function (result) {
                    console.log(result);
                }
            });
        }
    }
}