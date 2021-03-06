var Numeric = (function () {
    function Numeric() {
    }
    Numeric.prototype.decimal = function (suffix) {
        $('.decimal').css({ 'text-align': 'right' }).inputmask('decimal', {
            radixPoint: '.',
            digits: 2,
        });
    };
    Numeric.prototype.currency = function (suffix) {
        $('.currency').css({ 'text-align': 'right' }).inputmask('decimal', {
            radixPoint: '.',
            digits: 2,
            // min            : 0,
            // max            : 10000,
            // groupSeparator : '.',
            // autoGroup      : true,
            suffix: '$',
        });
    };
    Numeric.prototype.percentage = function (suffix) {
        $('.percentage').css({ 'text-align': 'right' }).inputmask('decimal', {
            radixPoint: '.',
            digits: 2,
            // groupSeparator : '.',
            // autoGroup      : true,
            //suffix         : ' %',
            max: 100
        });
    };
    Numeric.prototype.integer = function (suffix) {
        $('.integer').css({ 'text-align': 'right' }).inputmask('integer');
    };
    Numeric.prototype.min = function () {
        $('.min').css({ 'text-align': 'right' }).inputmask('decimal', {
            radixPoint: '.',
            digits: 2,
        });
    };
    return Numeric;
}());
var nm = new Numeric();
nm.decimal();
nm.currency();
nm.percentage();
nm.integer();
nm.min();
//# sourceMappingURL=Numeric.js.map