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
        var controls   = $(this.classSourceControls);
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
                        /**
                        Am scos ca sa nu se puna automat pe 0.
                        Gestionez combobox-urile din "custom js"
                        **/
                        // $(this).val(0).trigger('change');
                        break;
                    case 'select2' :
                        $(this).val([]).trigger('change');
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

	return mixin;

}])