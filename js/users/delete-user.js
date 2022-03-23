jQuery(function($){

    $(document).on('click', '.delete-user-button', function(){

        var user_id = $(this).attr('data-id');

        $('#mainModal').modal('toggle');
        $('.modal-dialog').html (`
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mainModalLabel">Удалить пользователя</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="remove-button" data-id="`+user_id+`">Удалить</button>
          </div>
        </div>
        `);

    });

    $(document).on('click', '#remove-button', function(){

        var user_id = $(this).attr('data-id');

        let form_data = new FormData();

        form_data.append('id', user_id);


        $.ajax({
            url: "users/delete.php",
            type : "POST",
            dataType : 'json',
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#content_body').empty();
                $('#mainModal').modal('toggle');
                $('.modal-dialog').html('');
                showUsers();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

    });
});