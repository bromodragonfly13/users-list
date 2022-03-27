jQuery(function($){
    var user_id;
    $(document).on('click', '.edit-user-button', function(){

        $('#update-user-button').attr('hidden', false);
        $('#store-user-button').attr('hidden', true);
        $('#mainModalLabel').text('Update user');

        user_id = $(this).attr('data-id');

        let form_data = new FormData();
        form_data.append('id', user_id);


        $.ajax({
            url: "users/read_one.php",
            type : "POST",
            dataType : 'json',
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#user-form-modal').modal('toggle');
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


    });


    $(document).on('click', '#update-user-button', function(e){
        e.preventDefault();
        
        let form_data = new FormData(document.getElementById("userForm"));

        form_data.append('id', user_id);

        if($('.switch_checkbox').prop('checked') == true){
            form_data.append('status', 1);
           } else{
            form_data.append('status', 0);
        }


        $.ajax({
            url: "users/update.php",
            type : "POST",
            contentType: false,
            processData: false,
            cache: false,
            data : form_data,
            success : function(result) {
                $('#user-form-modal').modal('toggle');

                let user_item = `
                <tr id="record-`+result.id+`">
                <td class="align-middle">
                  <div
                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                    <input type="checkbox" class="custom-control-input" id="item-`+result.id+`">
                    <label class="custom-control-label" for="item-`+result.id+`"></label>
                  </div>
                </td>
                <td class="text-nowrap align-middle">`+result.l_name+' '+result.f_name+`</td>
                <td class="text-nowrap align-middle"><span>`;
                 if(result.role == 1){
                  user_item += 'Active';
                 }
                 if(result.role == 2){
                  user_item += 'User';
                 }
                 if(result.role == 3){
                  user_item += 'Admin';
                 }
  
  
                user_item += `</span></td>
                <td class="text-center align-middle"><i class="fa fa-circle `;
                if(result.status == 1){
                  user_item +=  'active-circle';
                }
                else {
                  user_item +=  'not-active-circle';
                }
                 
                user_item += `" id="status-`+result.id+`"></i></td>
                <td class="text-center align-middle">
                  <div class="btn-group align-top">
                    <button class="btn btn-sm btn-outline-secondary badge edit-user-button" type="button" data-id="`+result.id+`">Edit</button>
                    <button class="btn btn-sm btn-outline-secondary badge" type="button"><i
                        class="fa fa-trash"></i></button>
                  </div>
                </td>
              </tr>
                `;

                $('#record-'+result.id).replaceWith(user_item);

            },
            error: function(xhr, resp, text) {
                $('.errors').attr('hidden', false);
                $('.errors').html(xhr.responseJSON.message);
            }
        });


    });

});