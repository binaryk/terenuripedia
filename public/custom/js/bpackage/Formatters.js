var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var Formatters;
(function (Formatters) {
    var Inputs = (function () {
        function Inputs() {
            this.selectors = [];
        }
        Inputs.prototype.addSelector = function () {
            var selectors = [];
            for (var _i = 0; _i < arguments.length; _i++) {
                selectors[_i - 0] = arguments[_i];
            }
            for (var i = 0; i < selectors.length; i++) {
                this.selectors.push(selectors[i]);
            }
        };
        Inputs.prototype.addSelectors = function (selectors) {
            this.selectors = selectors;
        };
        return Inputs;
    })();
    Formatters.Inputs = Inputs;
    var Combobox = (function (_super) {
        __extends(Combobox, _super);
        function Combobox() {
            _super.call(this);
        }
        Combobox.prototype.format = function () {
            this.selectors.forEach(function (el) {
                if ($.isFunction(jQuery().select2)) {
                    $(el).select2();
                }
                else {
                    throw Error('Select 2 function is not defined.');
                }
            });
        };
        Combobox.prototype.request = function () {
            var _that = this;
            var $select = $("#id_locatie");
            $select.select2({
                minimumInputLength: 4,
                tags: [],
                ajax: {
                    url: _that.url,
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    data: function (term) {
                        return {
                            txt: term
                        };
                    },
                    processResults: function (data) {
                        console.log('local', data);
                        return {
                            results: $.map(data, function (item) {
                                console.log(item);
                                return {
                                    text: item.text,
                                    slug: item.slug,
                                    id: item.id
                                };
                            })
                        };
                    }
                }
            });
        };
        return Combobox;
    })(Inputs);
    Formatters.Combobox = Combobox;
    var Textbox = (function (_super) {
        __extends(Textbox, _super);
        function Textbox() {
            _super.call(this);
        }
        Textbox.prototype.format = function () {
            this.selectors.forEach(function (el) {
            });
        };
        return Textbox;
    })(Inputs);
    Formatters.Textbox = Textbox;
})(Formatters || (Formatters = {}));
var fm = new Formatters.Combobox();
fm.addSelectors([".multiple_class", "#id_tip_teren", "#negociabil"]);
fm.format();
var tb = new Formatters.Textbox();
tb.addSelector("#title");
tb.format();
//# sourceMappingURL=Formatters.js.map