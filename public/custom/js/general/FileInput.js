var App;
(function (App) {
    var FileInput = (function () {
        function FileInput(input_selector, upload_route, delete_route) {
            var _this = this;
            this.input_selector = input_selector;
            this.upload_route = upload_route;
            this.delete_route = delete_route;
            this.inited = false;
            this.terrain_id = 0;
            this.onFileUploaded = function (event, data, previewId, index) {
                console.log(data.response);
                $('#photo').attr('src', data.response.path);
                $(_this.input_selector).fileinput('clear');
            };
            this.deleteFile = function (id) {
                var _that = _this;
                $.ajax({
                    url: _that.delete_route,
                    type: 'post',
                    dataType: 'json',
                    data: { 'id': id },
                    success: function (result) {
                        console.log(result);
                    }
                });
            };
        }
        FileInput.prototype.init = function (terrain_id, callback) {
            var _that = this;
            console.log('it', terrain_id);
            _that.terrain_id = terrain_id;
            if (_that.object) {
                _that.object.fileinput('reset');
            }
            ;
            _that.object = $(_that.input_selector).fileinput({
                'showPreview': true,
                'allowedFileExtensions': ['jpg', 'png', 'gif'],
                'showUpload': true,
                'dropZoneEnabled': false,
                'browseLabel': 'Alege fişier',
                'removeLabel': 'Şterge selecţia',
                'uploadLabel': 'Încarcă fişierul',
                'uploadAsync': true,
                'uploadUrl': _that.upload_route,
                'uploadExtraData': function () {
                    console.log('jos', _that.terrain_id);
                    return {
                        terrain_id: _that.terrain_id
                    };
                },
                'fileActionSettings': {
                    'removeTitle': 'Şterge selecţia',
                    'uploadTitle': 'Încarcă fişierul',
                    'indicatorNewTitle': 'Fişierul nu este încărcat'
                },
                'maxFileCount': 10
            });
            if (!this.inited) {
                _that.object.on('fileuploaded', callback);
            }
            this.inited = true;
        };
        return FileInput;
    }());
    App.FileInput = FileInput;
})(App || (App = {}));
//# sourceMappingURL=FileInput.js.map