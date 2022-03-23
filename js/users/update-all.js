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
        if(!checkedInput.length == 0){
            showButtons();
        } else{
            hideButtons();
        }


    });

    $(document).on("change", ".switch_checkbox", function () {
        var status = 0;
        if($(".switch_checkbox").prop('checked')){
            status = 1;
        }

        checkedInput.forEach(function(user_id) {

            let form_data = new FormData();
            form_data.append('id', user_id);
            form_data.append('status', status);

            $.ajax({
                url: "users/update_status.php",
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
        hideButtons();
        showUsers();

    });

    $(document).on("change", ".item-checkbox", function () {
        checkedInput = [];
            $('.item-checkbox').each(function(id, el) {
                if(this.checked) {
                    checkedInput.push($(el).attr('data-id'));
                }
            });
        if(!checkedInput.length == 0){
            showButtons();
        } else{
            hideButtons();
        }

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
        hideButtons();
        showUsers();
    });

    


    function showButtons(){
        $('.delete-all-user-button').removeAttr('hidden');
        $('.switch').removeAttr('hidden');
        $('.switch_text').removeAttr('hidden');
        if($('.active-circle').length == checkedInput.length){
            $('.switch_checkbox').prop('checked', true);
        } else{
            $('.switch_checkbox').prop('checked', false);
        }

    }
    function hideButtons(){
        $('.delete-all-user-button').attr('hidden', true);
        $('.switch').attr('hidden', true);
        $('.switch_text').attr('hidden', true);
    }






});