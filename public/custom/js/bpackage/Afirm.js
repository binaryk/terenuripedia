var App;
(function (App) {
    var Afirm = (function () {
        function Afirm() {
        }
        Afirm.prototype.success = function (message) {
            swal("Succes!", message, "success");
        };
        Afirm.prototype.warning = function (message) {
            swal("Atenție!", message, "warning");
        };
        Afirm.prototype.error = function (message) {
            swal("Eroare!", message, "error");
        };
        Afirm.prototype.question = function (title, message, type) {
            var _that = this;
            swal({
                title: title,
                text: message,
                type: type ? type : "success",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Da!",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    _that.onConfirm();
                }
                else {
                    _that.onCancel();
                }
            });
        };
        Afirm.prototype.onCancel = function () {
            console.log('cancel');
        };
        Afirm.prototype.onConfirm = function () {
            console.log('confirm');
        };
        return Afirm;
    }());
    App.Afirm = Afirm;
})(App || (App = {}));
//# sourceMappingURL=Afirm.js.map