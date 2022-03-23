jQuery(function($){
    showUsers();
})

function showUsers(){
    $.getJSON("/users/read.php", function(data){
        $.each(data.records, function(key, val) {
        var read_products_html= `
        <tr>
        <td class="align-middle">
        <div
            class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
            <input type="checkbox" class="custom-control-input item-checkbox" id="item-`+val.id+`" data-id="`+val.id+`">
            <label class="custom-control-label" for="item-`+val.id+`"></label>
        </div>
        </td>
        <td class="text-nowrap align-middle">`+ val.l_name + ` `+val.f_name+`</td>
        <td class="text-nowrap align-middle"><span>`;
        
        if(val.role==1){
            read_products_html += ` Active `;
        }
        if(val.role==2){
            read_products_html += ` User `;
        }
        if(val.role==3){
            read_products_html += ` Admin `;
        }

        read_products_html += `</span></td>
        <td class="text-center align-middle"><i class="fa fa-circle `; 

        if(val.status==1){
            read_products_html += `active-circle`;
        } else{
            read_products_html += `not-active-circle`;
        }
        
        read_products_html += `"></i></td>
        <td class="text-center align-middle">
        <div class="btn-group align-top">
            <button class="btn btn-sm btn-outline-secondary badge edit-user-button" type="button" data-toggle="modal"
            data-target="#editModal" data-id='` + val.id + `'>Edit</button>
            <button class="btn btn-sm btn-outline-secondary badge delete-user-button" type="button" data-id='` + val.id + `'>
            <i class="fa fa-trash" ></i></button>
        </div>
        </td>
    </tr>
        `;

    $("#content_body").append(read_products_html);
    

    });

});
}