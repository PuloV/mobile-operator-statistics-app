<div id="labelPieChart{{scope}}" style="height:300px;"></div>


<!-- Modal -->
<div id="labelPieChartModal{{scope}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{modal_header}}</h4>
      </div>
      <div class="modal-body">
        <p id='labelPieChartModalMessage{{scope}}'></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){

  /*
  DEFAULT STRUCTURE SHOULD BE 
  {
    element: 'labelPieChart{{scope}}',
    data: [
      {value: 60, label: 'Mtel'},
      {value: 25, label: 'Telenor'},
      {value: 15, label: 'Vivacom'}
    ],
    colors:['#FF3835','#515151','#6C76FF'],
    formatter: function (x) { return x + "%"}
  }
 */
  var pieChartData = JSON.parse('{{pie_data_json}}')

  pieChartData.formatter = function (x) { return x + "%"}
  pieChartData.element   = 'labelPieChart{{scope}}'

  pieChartData.data = pieChartData.data.map(function(item) {
    var parsedValue = item;
    parsedValue.value = parseFloat(item.value);
    return parsedValue;
  })
  
  Morris.Donut(pieChartData).on('click', function(i, row){
    $("#labelPieChartModalMessage{{scope}}").html(row.modal_message);
    $("#labelPieChartModal{{scope}}").modal('show');
  });
});
</script>