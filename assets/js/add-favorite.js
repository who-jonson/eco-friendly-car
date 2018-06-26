$(document).ready(function() {
    $('#addFav').click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "http://localhost/eco-friendly-car/ajax-api/add-favorite",
            method: "post",
            data: $('#add-favorite').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg === '1'){
                    $('#addFav').hide();
                    $('#removeFav').show();
                }
                else {
                    alert("Something went wrong!");
                }
            }
        });
    });

    $('#removeFav').click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "http://localhost/eco-friendly-car/ajax-api/remove-favorite",
            method: "post",
            data: $('#add-favorite').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg === '1'){
                    $('#removeFav').hide();
                    $('#addFav').show();
                }
                else {
                    alert("Something went wrong!");
                }
            }
        });
    });

});
