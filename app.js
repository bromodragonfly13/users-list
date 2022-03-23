jQuery(function($){

    app_html = `
    <div class="e-table table-hover">
    <div class="table-responsive table-lg mt-3">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="align-top">
              <div
                class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                <input type="checkbox" class="custom-control-input" id="all-items">
                <label class="custom-control-label" for="all-items"></label>
              </div>
            </th>
            <th class="max-width">Name</th>
            <th class="sortable">Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="content_body">
        </tbody>
      </table>
    </div>
  </div>
    `;

    $("#app").html(app_html);
});

$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
