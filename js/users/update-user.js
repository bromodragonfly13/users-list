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
                $("#f_name_edit").val("");
                $("#l_name_edit").val("");
                $("#status_edit").val("");
                $("#role_edit").val("");
                $('#editModal').modal('toggle');
                showUsers();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });


    });

});