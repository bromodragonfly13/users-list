jQuery(function($){
    var user_id;
    $(document).on('click', '.edit-user-button', function(){

        $('#update-user-button').attr('hidden', false);
        $('#store-user-button').attr('hidden', true);
        $('.errors').attr('hidden', true);
        $('#mainModalLabel').text('Update user');

        user_id = $(this).attr('data-id');

        let form_data = new FormData();
        form_data.append('id', user_id);


        $.ajax({
            url: "users/read_one.php",
            type : "POST",
            dataType : 'json',
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#user-form-modal').modal('toggle');

                let user = result.user;

                $("#f_name").val(user.f_name);
                $("#l_name").val(user.l_name);
                $("#role").val(user.role).change();
                if(user.status == 1){
                  $(".switch_checkbox").prop("checked", true);
                } else{
                  $(".switch_checkbox").prop("checked", false);
                }
    
    
            },
            error: function(xhr, resp, text) {
                $('.errors').attr('hidden', false);
                $('.errors').html(xhr.responseJSON.message);
            }
        });


    });


    $(document).on('click', '#update-user-button', function(e){
        e.preventDefault();
        
        let form_data = new FormData(document.getElementById("userForm"));

        form_data.append('id', user_id);

        if($('.switch_checkbox').prop('checked') == true){
            form_data.append('status', 1);
           } else{
            form_data.append('status', 0);
        }


        $.ajax({
            url: "users/update.php",
            type : "POST",
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#user-form-modal').modal('toggle');

                let user = result.user;

                $('#name-'+user.id).text(user.l_name+' '+user.f_name);

                if(user.status == 1){
                  $('#status-'+user.id).removeClass('not-active-circle').addClass('active-circle');
                }
                if(user.status == 0){
                    $('#status-'+user.id).removeClass('active-circle').addClass('not-active-circle');
                }

                if(user.role == 1){
                  $('#role-'+user.id).html('<span>User</span>');
                }
                if(user.role == 2){
                    $('#role-'+user.id).html('<span>Admin</span>');
                }


            },
            error: function(xhr, resp, text) {
                $('.errors').attr('hidden', false);
                console.log(xhr.responseJSON.error.message);
                $('.errors').html(xhr.responseJSON.error.message);
            }
        });


    });

});