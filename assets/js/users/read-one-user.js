function showOneUser(user_id){

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
            
            $("#f_name").val(result.f_name);
            $("#l_name").val(result.l_name);
            $("#role").val(result.role).change();
            if(result.status == 1){
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
}