module App{
    declare var $;
    interface IData{
        key: string,
        value: any
    }
    export class Call{
        private data: [IData];

        constructor(public url: string, public type: string, public dataType?: string){
            if(! this.dataType) this.dataType = 'json';
        }

        setData = (data: IData) =>
        {
            this.data[data.key] = data.value;
            return this;
        }



        setUrl = (url: string) =>
        {
            this.url = url;
            return this;
        }

        onSuccess = (data) => {

        }

        success = (cb) => {
            this.onSuccess = cb;
        }

        request = () => {
            var that = this;
            $.ajax({
                url      : this.url,
                type     : this.type,
                dataType : this.dataType,
                data     : this.data,
                success  : function( result )
                {
                    return that.onSuccess(result);
                }
            });
        }

    }
}