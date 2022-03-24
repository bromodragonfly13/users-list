$(document).ready(function() {

    let checkedInput = [];

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


        if(checkedInput.length == 0){
            $('#mainModal').modal('toggle');
            $('.modal-dialog').html (`
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="mainModalLabel">Удалить пользователей</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="alert alert-danger errors" >
                Пустой список
             </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
              </div>
            </div>
            `);
        }
        else{
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
            showUsers();
    

        }

    });

    








});