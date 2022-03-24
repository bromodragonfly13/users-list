$(document).ready(function() {

    
    $("table").simpleCheckboxTable();

    var checkedInput = [];


    $('#all-items').change(function() {
        checkedInput = [];
        if(this.checked) {
            $('.item-checkbox').each(function(id, el) {
                checkedInput.push($(el).attr('data-id'));
            });
        }


    });


    $(document).on("change", ".item-checkbox", function () {
        checkedInput = [];
            $('.item-checkbox').each(function(id, el) {
                if(this.checked) {
                    checkedInput.push($(el).attr('data-id'));
                }
            });


    });

    $(document).on('click', '.delete-all-user-button', function(){

        checkedInput.forEach(function(user_id) {

            let form_data = new FormData();
            form_data.append('id', user_id);

            $.ajax({
                url: "users/delete.php",
                type : "POST",
                contentType: false,
                processData: false,
                cache: false,
                data : form_data,
                success : function(result) {
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            });
        });

        $('input:checked').prop('checked', false);
        $('#content_body').empty();

    });

    








});