function showOneUser(user_id){

    let form_data = new FormData();

    form_data.append('id', user_id);

    $('#mainModal').modal('toggle');
    $('.modal-dialog').html (`
    <form action="" id="myEditForm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Обновить информацию</h5>
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
                    <select class="form-control" id="role" name="role">
                      <option value="1">Active</option>
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
        <button type="submit" class="btn btn-primary" id="update-user-button">Обновить</button>
      </div>
    </div>
  </form> 
    `);



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