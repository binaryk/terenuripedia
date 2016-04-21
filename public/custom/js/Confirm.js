var App;
(function (App) {
    var Confirm = (function () {
        function Confirm(nu, da, url) {
            this.nu = nu;
            this.da = da;
            this.url = url;
        }
        Confirm.prototype.handle = function () {
            var _that = this;
            $('.aprobare').click(function () {
                var id = $(this).closest('tr').data('id');
                console.log(id);
                $.ajax({
                    method: "POST",
                    url: _that.url,
                    data: { id: id }
                });
            });
        };
        return Confirm;
    })();
    App.Confirm = Confirm;
})(App || (App = {}));
//# sourceMappingURL=Confirm.js.map