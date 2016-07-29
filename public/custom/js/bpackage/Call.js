var App;
(function (App) {
    var Call = (function () {
        function Call(url, type, dataType) {
            var _this = this;
            this.url = url;
            this.type = type;
            this.dataType = dataType;
            this.setData = function (data) {
                _this.data[data.key] = data.value;
                return _this;
            };
            this.setUrl = function (url) {
                _this.url = url;
                return _this;
            };
            this.onSuccess = function (data) {
            };
            this.success = function (cb) {
                _this.onSuccess = cb;
            };
            this.request = function () {
                var that = _this;
                $.ajax({
                    url: _this.url,
                    type: _this.type,
                    dataType: _this.dataType,
                    data: _this.data,
                    success: function (result) {
                        return that.onSuccess(result);
                    }
                });
            };
            if (!this.dataType)
                this.dataType = 'json';
        }
        return Call;
    }());
    App.Call = Call;
})(App || (App = {}));
//# sourceMappingURL=Call.js.map