;
app.factory('FormService', ['$rootScope','$http','$timeout', function($rootScope, $http, $timeout){
	var mixin = {
		classSourceControls: '.data-source'
	};

	mixin.controlvalue = function( control )
    {
        var result = null;
        switch(control.data('control-type'))
        {
            case 'textbox'    :
            case 'persistent' :
            case 'combobox'   :
            case 'select2'    :
            case 'editbox'    :
                result = control.val(); 
                if( control.hasClass('currency') || control.hasClass('decimal') )
                {
                    result = mixin.tofloat(result);
                }
                else
                {
                    if(control.hasClass('moment'))
                    {
                        var __date = moment(result, 'DD.MM.YYYY');
                        result = __date.format('YYYY-MM-DD');
                    }
                }
                break;
            case 'checkbox'   :
                result = control.prop('checked') ? control.data('on') : control.data('off');  
                break;
            case 'radiobox'   :
                var sibling = $('[name='+control.attr('name')+']');
                sibling.each(function(i){
                    if($(this).prop('checked')){
                        result = $(this).val();
                    }
                });
                break;
        }
        return result;
    };

    mixin.datasource = function()
    {
        var self     = this;
        var result   = new Object();
        var controls = $(mixin.classSourceControls);
        controls.each( function(i) {
            result[$(this).data('control-source')] = mixin.controlvalue( $(this) ); //$scope.controlvalue($(this));
        });
        return result;
    };


    mixin.emptyControls = function()
    {
        var controls   = $(mixin.classSourceControls);

        controls.each(function(i){
            if( ! $(this).hasClass('no-empty') )
            {
                var formgroup = $(this).closest('.form-group');
                switch($(this).data('control-type'))
                {
                    case 'textbox'  :  
                    case 'editbox'  :
                        $(this).val('');
                        break;
                    case 'combobox' :
                        if( $.isFunction(jQuery().select2) ){
                          $(this).select2('val','');
                        }
                         $(this).val('');//.trigger('change');
                        break;
                    case 'select2' :
                        $(this).val('').trigger('change');
                }
                formgroup.removeClass('has-error');
                formgroup.find('.error-sign').remove();
                formgroup.find('.help-block').remove();
                $(this).prop('disabled', false);
                $(this).css({'background-color':'#fff'});
            }
        });

        console.log('3.2. -----> Custom after Empty controls');
    };

    mixin.tofloat = function(value)
    {
        return numeral().unformat(value);
        // return numeral().unformat(value);
       /* value = value.replace('.','');
        return value.replace(',','.');*/
    }

    mixin.showFieldsErrors = function(fieldserrors)
    {
        for(field in fieldserrors)
        {
            var control   = $(mixin.classSourceControls + '[data-control-source="' + field + '"]');
            switch( control.data('control-type') )
            {
                case 'textbox'   :
                case 'combobox'  :
                case 'editbox'   :
                case 'select2'   :
                    var formgroup = control.closest('.form-group');
                    if(formgroup.length > 0)
                    {
                        formgroup.find('.error-sign').remove();
                        formgroup.find('.help-block').remove();
                        formgroup.addClass('has-error')
                            //.prepend('<label class="control-label error-sign" for="'+ field + '"><i class="fa fa-times-circle-o"></i></label>')
                            .append('<p class="help-block has-error">' + fieldserrors[field] + '</p>');
                    }
                    var formgroup = control.closest('.input-group').parent();
                    if(formgroup.length > 0)
                    {
                        formgroup.find('.error-sign').remove();
                        formgroup.find('.help-block').remove();
                        formgroup.addClass('has-error')
                            //.prepend('<label class="control-label error-sign" for="'+ field + '"><i class="fa fa-times-circle-o"></i></label>')
                            .append('<p class="help-block has-error">' + fieldserrors[field] + '</p>');
                    }
                    break;
            }
        }
    };

    mixin.removeFieldsErrors = function(){
        var control   = $(mixin.classSourceControls);
        var formgroup = control.closest('.form-group');
        formgroup.find('.help-block').remove();
        formgroup.removeClass('has-error')
    }

  mixin.safe = function(cb){
    $timeout(function(){
      cb();
    },450);
  }

	return mixin;

}])