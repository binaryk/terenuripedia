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
fm.addSelectors([".multiple_class", "#id_tip_teren","#destinatie","#front_stradal", "#negociabil"]);
fm.format();

var tb = new Formatters.Textbox();
tb.addSelector("#title");
tb.format();