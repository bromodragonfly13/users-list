jQuery(function($){

    $(document).on('click', '.create-user-button', function(e){

      $('.switch_checkbox').prop('checked', false);

        $('#mainModal').modal('toggle');
        $('.modal-dialog').html (`
        <form action="" id="myCreateForm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mainModalLabel">Новый пользователь</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="modal-body">
              <div class="py-1">
                  <div class="row">
                    <div class="col">
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="f_name" id="f_name" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label>Last name</label>
                            <input class="form-control" type="text" name="l_name" id="l_name" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" id="" name="role">
                          <option value="1" checked>Active</option>
                          <option value="2">User</option>
                          <option value="3">Admin</option>
                        </select>
                      </div>
                      <div class="mt-2">
                        <label for="">Status: </label>
                        <div class="form-check form-check-inline ml-2">
                          <label class="switch">
                          <input type="checkbox" class="switch_checkbox">
                          <span class="slider round"></span>
                        </label>
                      </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="alert alert-danger errors" hidden>
            Ошибка
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            <button type="submit" class="btn btn-primary" id="store-user-button">Добавить</button>
          </div>
        </div>
      </form> 
        `);

    });

    $(document).on('click', '#store-user-button', function(e){
        
        e.preventDefault();

        let form_data = new FormData(document.getElementById("myCreateForm"));

       if($('.switch_checkbox').prop('checked') == true){
        form_data.append('status', 1);
       } else{
        form_data.append('status', 0);
       }




        $.ajax({
            url: "users/create.php",
            type : "POST",
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
                $('.errors').attr('hidden', false);
                $('.errors').html(xhr.responseJSON.message);
            }
        });

        $('#createModal').modal('toggle');

    });
    return false;
});