declare var $;
class Numeric{
    decimal(suffix?: string){
        $('.decimal').css({'text-align':'right'}).inputmask('decimal', {
            radixPoint     : '.',
            digits         : 2,
            // groupSeparator : '.',
            // autoGroup      : true,
            // suffix         : suffix,
            // max            : 10000
        });
    }

    currency(suffix?:string){
        $('.currency').css({'text-align':'right'}).inputmask('decimal', {
            radixPoint     : '.',
            digits         : 2,
            // min            : 0,
            // max            : 10000,
            // groupSeparator : '.',
            // autoGroup      : true,
            suffix         : '$',
        });
    }

    percentage(suffix?:string){
        $('.percentage').css({'text-align':'right'}).inputmask('decimal', {
            radixPoint     : '.',
            digits         : 2,
            // groupSeparator : '.',
            // autoGroup      : true,
            //suffix         : ' %',
            max            : 100
        });
    }

    integer(suffix?:string){
        $('.integer').css({'text-align':'right'}).inputmask('integer');
    }

    min(){
        $('.min').css({'text-align':'right'}).inputmask('decimal', {
            radixPoint     : '.',
            digits         : 2,
            // groupSeparator : '.',
            // autoGroup      : true,
            // suffix         : suffix,
            // max            : 10000
        });
    }
}

var nm = new Numeric();
nm.decimal();
nm.currency();
nm.percentage();
nm.integer();
nm.min();