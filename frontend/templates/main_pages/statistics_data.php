{{header}}

<!-- Modal -->
<div id="modalAddEditStatisticsData" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Entry</h4>
      </div>
      <div class="modal-body">
        <form class="" style="min-height:30%;max-height:50%;overflow-x:auto;">
          
          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control android" id='name' name='name'>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="gender">Gender</label>
            <div class="col-sm-10">
              <select id='gender' name='gender' class="form-control android">
                <option value='M'>Male</option>
                <option value='F'>Female</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="age">Age</label>
            <div class="col-sm-10">
              <input type="text" class="form-control android number" id='age' name='age'>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="mobile_operator">Operator</label>
            <div class="col-sm-10">
            
              <select id='mobile_operator' name='mobile_operator' class="form-control android">
                <option value='telenor'>Telenor</option>
                <option value='mtel'>M-tel</option>
                <option value='vivacom'>Vivacom</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="date">Date</label>
            <div class="col-sm-10">
              <input type="text" class="form-control android edit date" data-format="yyyy-MM-dd" id='respondent_date' name='respondent_date'>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="minutes">Minutes</label>
            <div class="col-sm-10">
              <input type="text" class="form-control android number" id='minutes' name='minutes'>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="megabytes">Megabytes</label>
            <div class="col-sm-10">
              <input type="text" class="form-control android number" id='megabytes' name='megabytes'>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="sms">SMS</label>
            <div class="col-sm-10">
              <input type="text" class="form-control android number" id='sms' name='sms'>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label text-right" for="tax">Tax</label>
            <div class="col-sm-10">
              <input type="text" class="form-control android number numberDecimal" id='tax' name='tax'>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
  $('#respondent_date').datepicker({
    format: 'yyyy-mm-dd'
  });

  $('.number').on('change', function(event) {
    var element = $(this);
    var value = element.val();
    if (element.hasClass('numberDecimal')){
      value = parseFloat(value);
    } else {
      value = parseInt(value);
    }
    
    if (!isNaN(value) && value) {
      element.val(value)
    } else {
      element.val(0);
    }

  });
</script>


<!-- start: Content -->
<div id="content">
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Respondents</h3>
          <span class="" style="display: inline-block;">
            <form type="GET" id='for_date_form' >
            <input id="for_date" name="for_date" value="{{for_date}}" placeholder="Select Start Date" class="edit date" data-format="yyyy-MM-dd" type="text" tabindex='5' />
            </form>
          </span>
          <span class="pull-right" style="display: inline-block;padding-right:20px;">
            <input id='add_statistic_data' class="btn btn-outline btn-primary" value="Add new entry" type="submit">
          </span>
          <script type="text/javascript">
            $('#for_date').datepicker({
              format: 'yyyy-mm-dd',
              date: '{{for_date}}'
            }).on('change', function(event) {
              // event.preventDefault();
              /* Act on the event */
              $("#for_date_form").submit();
            });

            $('#add_statistic_data').on('click', function(event) {
              event.preventDefault();
              $('#modalAddEditStatisticsData').modal('show')
            });
            
          </script>
          
        </div>
        <div class="panel-body">
          <div class="responsive-table">
          <table id="datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="sorting">Name</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Mobile Operator</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {{statistics_entries}}
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
  });
</script>
<!-- end: Javascript -->
