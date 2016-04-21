module App{
    declare var $;
    declare var swal;
    export class Afirm{
        constructor(){

        }

        success(message : string){
            swal("Succes!", message, "success")
        }

        warning(message: string){
            swal("Atenție!", message, "warning")
        }

        error(message: string){
            swal("Eroare!", message, "error")
        }

        question(title: string, message: string, type?: string){
            const _that = this;
            swal({
                    title : title,
                    text : message,
                    type : type ? type : "success",
                    showCancelButton : true,
                    confirmButtonColor : "#DD6B55",
                    confirmButtonText : "Da!",
                    closeOnConfirm : true
                },
                function (isConfirm) {
                    if(isConfirm){
                        _that.onConfirm();
                    }else{
                        _that.onCancel();
                    }
                });
        }

        onCancel(){
            console.log('cancel');

        }

        onConfirm(){
            console.log('confirm');
        }



    }
}