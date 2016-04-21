module App{
    declare var $;
    export class Confirm{
        constructor(public nu, public da, public url){

        }

        handle(){
            var _that = this;
            $('.aprobare').click(function(){
                var id = $(this).closest('tr').data('id');
                console.log(id);

                $.ajax({
                    method: "POST",
                    url: _that.url,
                    data: {id: id}
                })
            })
        }
    }
}