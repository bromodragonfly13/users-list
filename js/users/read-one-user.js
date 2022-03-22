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

            console.log(result.f_name)
            
            $("#f_name_edit").val(result.f_name);
            $("#l_name_edit").val(result.l_name);
            $("#role_edit").val(result.role).change();
            $("#statusEditRadio"+result.status).prop("checked", true);


        },
        error: function(xhr, resp, text) {
            console.log(xhr, resp, text);
        }
    });
}