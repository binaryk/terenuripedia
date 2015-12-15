function sweetConfirmDelete (successCallback, errorCallback) {
        swal({
            title: "Sunteti sigur?",
            text: 'Doriti sa stergeti inregistrarea ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Da, sunt sigur!',
            cancelButtonText: 'Anuleaza!!',
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(confirmed) {
            if(confirmed && typeof successCallback === "function") {
                successCallback();
            }else if(!confirmed && typeof errorCallback === "function") {
                errorCallback();
            }
        });
}

var confirmMessage = function(message){

    return {
        warning: function(){
            swal({   title: "Sunteti sigur?",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "DA, sunt sigur!",
            cancelButtonText: "NU, inchide!",
            closeOnConfirm: false,
            closeOnCancel: false },
            function(isConfirm){
                if (isConfirm) {
                   /* item_id = item.id;
                    $.post($scope.config.r_remove_item, {item_id: item_id }, function(data){
                        if(data != null){
                            $timeout(function(){ 
                                array.splice(index, 1); 
                            });
                        }
                    });*/
                    // swalInput(date, event);
                    swal("Success", "Capitolul a fost șters cu succes", "success");
                    return true;
                }
                else {
                    swal("Cancelled", "Capitolul nu a fost șters.", "error");
                    return false;
                }
            });
        }
    };
};