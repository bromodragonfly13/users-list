jQuery(function($){

    $(document).on('click', '.edit-user-button', function(){
        var user_id = $(this).attr('data-id');

        showOneUser(user_id);

    });
});