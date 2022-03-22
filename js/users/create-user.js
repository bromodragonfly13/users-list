jQuery(function($){

    $(document).on('click', '#store-user-button', function(e){
        
        e.preventDefault();

        let form_data = new FormData(document.getElementById("myForm"));

        $.ajax({
            url: "users/create.php",
            type : "POST",
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#content_body').empty();
                $("#f_name").val("");
                $("#l_name").val("");
                $("#status").val("");
                $("#role").val("");
                showUsers();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

        $('#createModal').modal('toggle');

    });
    return false;
});