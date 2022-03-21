jQuery(function($){
    showUsers();

    function showUsers(){
            $.getJSON("/users/read.php", function(data){
                $.each(data.records, function(key, val) {
                var read_products_html= `
                <tr>
                <td class="align-middle">
                <div
                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                    <input type="checkbox" class="custom-control-input" id="item-1">
                    <label class="custom-control-label" for="item-1"></label>
                </div>
                </td>
                <td class="text-nowrap align-middle">`+ val.l_name + ` `+val.f_name+`</td>
                <td class="text-nowrap align-middle"><span>`+val.role+`</span></td>
                <td class="text-center align-middle"><i class="fa fa-circle`; 

                if(val.status==1){
                    read_products_html += ` active-circle `;
                } else{
                    read_products_html += ` not-active-circle `;
                }
                
                read_products_html += `
                "></i></td>
                <td class="text-center align-middle">
                <div class="btn-group align-top">
                    <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal"
                    data-target="#user-form-modal" data-id='` + val.id + `'>Edit</button>
                    <button class="btn btn-sm btn-outline-secondary badge" type="button"><i
                        class="fa fa-trash" data-id='` + val.id + `'></i></button>
                </div>
                </td>
            </tr>
                `;

            $("#content_body").append(read_products_html);

        });

    });





}})