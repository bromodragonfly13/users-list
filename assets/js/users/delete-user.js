jQuery(function($){

    var user_id;

    $(document).on('click', '.delete-user-button', function(){

        user_id = $(this).attr('data-id');

        $('#message-modal').modal('toggle');
        $('#message-modal-title').html('Delete user');
        $('#message-modal-body').html('<p>Modal body text goes here.</p>');
        $('#remove-button').attr('hidden', false);


    });

    $(document).on('click', '#remove-button', function(){


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
                $('#message-modal').modal('toggle');
                $('#record-'+user_id).empty();

            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

    });
});