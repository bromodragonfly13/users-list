jQuery(function($){

    $(document).on('click', '.create-user-button', function(e){

      $('.switch_checkbox').prop('checked', false);
      $('#update-user-button').attr('hidden', true);
      $('#store-user-button').attr('hidden', false);
      $('#all-items').prop('checked', false);
      $('.errors').attr('hidden', true);
      $('#f_name').val('');
      $('#l_name').val('');
      $('#mainModalLabel').text('Create user');

      $('#user-form-modal').modal('toggle');

    });

    $(document).on('click', '#store-user-button', function(e){
        
        e.preventDefault();

        let form_data = new FormData(document.getElementById("userForm"));

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
              $('#mainModal').modal('toggle');
              let user = result.user;

              let user_item = `
              <tr id="record-`+user.id+`">
              <td class="align-middle">
                <div
                  class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                  <input type="checkbox" class="custom-control-input item-checkbox" id="item-`+user.id+`" data-id="`+user.id+`">
                  <label class="custom-control-label" for="item-`+user.id+`"></label>
                </div>
              </td>
              <td class="text-nowrap align-middle" id="name-`+user.id+`">`+user.l_name+' '+user.f_name+`</td>
              <td class="text-nowrap align-middle" id="role-`+user.id+`"><span>`;
               if(user.role == 1){
                user_item += 'User';
               }
               if(user.role == 2){
                user_item += 'Admin';
               }


              user_item += `</span></td>
              <td class="text-center align-middle"><i class="fa fa-circle `;
              if(user.status == 1){
                user_item +=  'active-circle';
              }
              else {
                user_item +=  'not-active-circle';
              }
               
              user_item += `" id="status-`+user.id+`"></i></td>
              <td class="text-center align-middle">
                <div class="btn-group align-top">
                  <button class="btn btn-sm btn-outline-secondary badge edit-user-button" type="button" data-id="`+user.id+`">Edit</button>
                  <button class="btn btn-sm btn-outline-secondary badge delete-user-button" type="button" data-id="`+user.id+`"><i
                      class="fa fa-trash"></i></button>
                </div>
              </td>
            </tr>
              `;

              $('tbody').append(user_item);
              $('#user-form-modal').modal('toggle');



            },
            error: function(xhr, resp, text) {
                $('.errors').attr('hidden', false);
                console.log(xhr.responseJSON.error.message);
                $('.errors').html(xhr.responseJSON.error.message);
            }
        });

    });
    

});