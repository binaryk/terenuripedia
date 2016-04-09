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
fm.addSelectors([".multiple_class", "#id_locatie", "#id_tip_teren", "#negociabil"]);
fm.format();

var tb = new Formatters.Textbox();
tb.addSelector("#title");
tb.format();