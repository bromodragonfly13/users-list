jQuery(function($){

    $(document).on('click', '.delete-user-button', function(){
        var user_id = $(this).attr('data-id');

        let form_data = new FormData();

        form_data.append('id', user_id);


        $.ajax({
            url: "users/delete.php",
            type : "POST",
            dataType : 'json',
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#content_body').empty();
                showUsers();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });
    });
});