module Formatters{
    declare var $;
    declare var jQuery;

    export class Inputs{
        selectors: string[];
        _self: any;
        constructor(){
            this.selectors = [];
        }

        addSelector(...selectors : string[]):void{
            for(var i = 0; i < selectors.length; i++){
                this.selectors.push(selectors[i]);
            }
        }

        addSelectors(selectors : string[]):void{
            this.selectors = selectors;
        }
    }

    export class Combobox extends Inputs{
        public url: string;
        constructor(){
            super();
        }

        format():void{
            this.selectors.forEach(function(el){

                if( $.isFunction(jQuery().select2) ){
                    $(el).select2();
                }else{
                    throw Error('Select 2 function is not defined.');
                }

            });
        }

        request():void{
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
                        console.log('local',data);
                        return {
                            results: $.map(data, function (item) {
                                console.log(item);
                                return {
                                    text: item.text,
                                    slug: item.slug,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
           var $option = $("<option selected></option>").val(3).text("Whatever Select2 should display");
            $select.append($option).trigger('change'); // append the option and update Select2
            $option.text("dasdsadsad").val(33); // update the text that is displayed (and maybe even the value)
            $option.removeData(); // remove any caching data that might be associated
            $select.trigger('change'); // notify JavaScript components of possible changes
          /*  $.ajax({ // make the request for the selected data object
                type: 'GET',
                url: '/api/for/single/creditor/' + initial_creditor_id,
                dataType: 'json'
            }).then(function (data) {
                // Here we should have the data object
                $option.text(data.text).val(data.id); // update the text that is displayed (and maybe even the value)
                $option.removeData(); // remove any caching data that might be associated
                $select.trigger('change'); // notify JavaScript components of possible changes
            });*/
        }
    }

    export class Textbox extends Inputs{
        constructor(){
            super();
        }

        format():void{
            this.selectors.forEach(function(el){
            });
        }
    }
}

var fm = new Formatters.Combobox();
fm.addSelectors([".multiple_class", "#id_tip_teren", "#negociabil"]);
fm.format();

var tb = new Formatters.Textbox();
tb.addSelector("#title");
tb.format();