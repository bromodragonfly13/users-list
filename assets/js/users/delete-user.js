jQuery(function($){

    var user_id;

    $(document).on('click', '.delete-user-button', function(){

        user_id = $(this).attr('data-id');

        $('#message-modal').modal('toggle');
        $('#message-modal-title').html('Delete user');
        $('#message-modal-body').html('<p>Are you sure you want to delete the user?</p>');
        $('#remove-button').attr('hidden', false);


    });

    $(document).on('click', '#remove-button', function(){


        let form_data = new FormData();

        form_data.append('id', user_id);
        console.log(user_id)



        $.ajax({
            url: "users/delete.php",
            type : "POST",
            dataType : 'json',
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#message-modal').modal('toggle');
                let user = result.user;
                $('#record-'+user.id).empty();

            },
            error: function(xhr, resp, text) {
                console.log(xhr.responseJSON.error.message);
            }
        });

    });
});