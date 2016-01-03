module Formatters{
    declare var $;

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
                $(el).select2();
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