jQuery(function($){
    var user_id;
    $(document).on('click', '.edit-user-button', function(){

        user_id = $(this).attr('data-id');

        showOneUser(user_id);

    });

    $(document).on('click', '#update-user-button', function(e){
        e.preventDefault();
        
        let form_data = new FormData(document.getElementById("myEditForm"));

        form_data.append('id', user_id);


        $.ajax({
            url: "users/update.php",
            type : "POST",
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#content_body').empty();
                $('#mainModal').modal('toggle');
                $('.modal-dialog').html('');
                showUsers();
            },
            error: function(xhr, resp, text) {
                $('.errors').attr('hidden', false);
                $('.errors').html(xhr.responseJSON.message);
            }
        });


    });

});