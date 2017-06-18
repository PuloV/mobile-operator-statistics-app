{{header}}

<!-- start: Content -->
<div id="content">
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Users</h3>          
        </div>
          <div id='errors'></div>
        <div class="panel-body">
          <div class="responsive-table">
          <table id="datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="sorting">Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {{users_entries}}
          </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>  
  </div>
</div>
<!-- end: content -->
{{footer}}

<!-- custom -->
<script src="{{PATH_APP}}frontend/asset/js/main.js"></script>
<script src="{{PATH_APP}}frontend/asset/js/plugins/jquery.datatables.min.js"></script>
<script src="{{PATH_APP}}frontend/asset/js/plugins/datatables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable').DataTable();

    $(".deleteEntry").on('click', function(event) {
      event.preventDefault();
      /* Act on the event */
      var id =  $(this).attr('data-id');

      $.ajax({
        type: 'post',
        url: '{{PATH_APP}}auth/delete_user',
        data: {
          id: id,
        },
        dataType: 'json'
      }).done(function(data){
        if(data.success == 1){
          $("#entry"+id).remove();
        } else {
          $('#errors').html(data.message_html)
        }
      });
    });    

    $(".editEntry").on('click', function(event) {
      event.preventDefault();
      /* Act on the event */
      var id =  $(this).attr('data-id');
      var role =  $("#role"+id).val(); 
      $.ajax({
        type: 'post',
        url: '{{PATH_APP}}auth/edit_user',
        data: {
          id: id,
          role: role,
        },
        dataType: 'json'
      }).done(function(data){
        if(data.success == 1){
          location.reload()
        } else {
          $('#errors').html(data.message_html)
        }
      });
    });



  });
</script>
<!-- end: Javascript -->
