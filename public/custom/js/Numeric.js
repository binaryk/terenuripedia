;function Numeric(){


  this.decimal  = function(suffix){
    $('.decimal').css({'text-align':'right'}).inputmask('decimal', {
      radixPoint     : '.',
      digits         : 2,
      // groupSeparator : '.',
      // autoGroup      : true,
      // suffix         : suffix,
      // max            : 10000
    });
  }

  this.currency  = function(suffix){
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

  this.percentage  = function(suffix){
    $('.percentage').css({'text-align':'right'}).inputmask('decimal', {
      radixPoint     : '.',
      digits         : 2,
      // groupSeparator : '.',
      // autoGroup      : true,
      //suffix         : ' %',
      max            : 100
    });
  }

  this.integer  = function(suffix){
    $('.integer').css({'text-align':'right'}).inputmask('integer');
  }

  this.min			= function(){
    $('.min').css({'text-align':'right'}).inputmask('decimal', {
      radixPoint     : '.',
      digits         : 2,
      // groupSeparator : '.',
      // autoGroup      : true,
      // suffix         : suffix,
      // max            : 10000
    });
  }



  this.formatInputs = function(){
    this.decimal();
    this.currency();
    this.percentage();
    this.integer();
    this.min();
  }
}