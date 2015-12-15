/*var saveData = function(data) {
    window.data_ = data;
};
jQuery(document).ready(function($) {
    $(".form_submit").on("submit", function(event) {
        event.preventDefault();
        var data = {
            form: $(this).serialize(),
            coords: window.data_,
            _token: $('[name=_token]').val()
        };
        console.log(data);
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: data,
            dataType: "json",
            success: function(data) {
                // do stuff 
                console.log(data);
                // location.reload();
            },
            error: function(data) {
                // do stuff 
                console.log(data);
            }
        });
    });
    setTimeout(function() {
        $('#restore').click();
    }, 1000);
});
var getData = function() {
    var out = [];
    $.ajax({
        url: save_url,
        type: 'POST',
        async: false,
        data: {
            _token: $('[name=_token]').val()
        },
        success: function(response) {
            out = response;
            console.log(response);
        }
    }).done(function(data) {
        console.log('FINISH');
    });
    return out;
};
*/