$(document).ready(function() {

    resetCheckbox();
    $('#one-action').val(0);
    $('#two-action').val(0);


    var checkedInput = [];


    $('#all-items').change(function() {
        checkedInput = [];
        if(this.checked) {
            $('.item-checkbox').each(function(id, el) {
                checkedInput.push($(el).attr('data-id'));
                $(this).prop('checked', true);
            });
        }
        else{
            checkedInput = [];
            $('.item-checkbox').each(function(id, el) {
                $(this).prop('checked', false);
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

            $('.item-checkbox').each(function(id, el) {
                if(this.checked) {
                    $('#all-items').prop('checked', true);
                }
                else{
                    $('#all-items').prop('checked', false);
                    return false;
                }
            });
    });


    $('#one-action').on('change', function(){
        $('#two-action').val($(this).val());
    });
    $('#two-action').on('change', function(){
        $('#one-action').val($(this).val());
    });

    $(document).on('click', '.update-all-user-button', function(){

        if(checkedInput.length == 0){
            $('#message-modal').modal('toggle');
            $('#message-modal-title').html('Update users');
            $('#message-modal-body').html('<p>No users selected</p>');
        }

        else if($('#one-action').val() == 0){
            $('#message-modal').modal('toggle');
            $('#message-modal-title').html('Update users');
            $('#message-modal-body').html('<p>No action selected</p>');
        }
        
        if($('#one-action').val() == 1){
            setStatus(checkedInput, 1);
        }
        if($('#one-action').val() == 2){
            setStatus(checkedInput, 0);
        }
        if($('#one-action').val() == 3){
           deleteUsers(checkedInput);
        }

        
    });

    function setStatus(checkedInput, status){

        let form_data = new FormData();

        ids = checkedInput + "";

        form_data.append('ids', ids);
        form_data.append('status', status);

            $.ajax({
                url: "users/mass_update_status.php",
                type : "POST",
                contentType: false,
                processData: false,
                cache: false,
                data : form_data,
                success : function(result) {
                    let items = Object.keys(result);

                    for (const user of items) {
                        if(status == 1){
                            $('#status-'+user).removeClass('not-active-circle').addClass('active-circle');
                        }
                        else{
                            $('#status-'+user).removeClass('active-circle').addClass('not-active-circle');
                        }
                      }

                      resetCheckbox();
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            });
    }

    function deleteUsers(checkedInput){

        let form_data = new FormData();

        ids = checkedInput + "";

        form_data.append('ids', ids);

        $.ajax({
            url: "users/mass_delete.php",
            type : "POST",
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                let items = Object.keys(result);
                for (const user of items) {
                    $('#record-'+user).empty();
                  }
                resetCheckbox();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

    }

    function resetCheckbox(){
        $('.item-checkbox').each(function(id, el) {
            $(this).prop('checked', false);
        });
        $('#all-items').prop('checked', false);
    }
});