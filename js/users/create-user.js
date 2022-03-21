jQuery(function($){

    $(document).on('click', '.create-user-button', function(){


        var create_user_html= `
        
        <div class="modal fade" role="dialog" tabindex="1" id="user-form-modal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit user</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="py-1">
                <form class="form" novalidate="">
                  <div class="row">
                    <div class="col">
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="name" placeholder="John" value="John">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label>Last name</label>
                            <input class="form-control" type="text" name="username" placeholder="Smith" value="Smith">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col d-flex justify-content-end">
                      <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
        `;

        $(Document).append(create_user_html);

    });
});