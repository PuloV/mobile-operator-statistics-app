<div id="barChart{{scope}}"></div>


<!-- Modal -->
<div id="labelBarChartModal{{scope}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{header_prefix}} <span id='labelBarChartModalHeader{{scope}}'> </span></h4>
      </div>
      <div class="modal-body">
        <div id="labelBarChartModalMessage{{scope}}" style="height:200px;width:200px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){

	/* DEFAULT STRUCTURE SHOULD BE 

	var barData = {
      element: 'bar-chart',
      data: [
        {x: '16-20', y: 3, z: 2, a: 3, 'messge': 'Lololo'},
        {x: '20-30', y: 2, z: null, a: 1, 'messge': 'Lololo'},
        {x: '30-40', y: 0, z: 2, a: 4, 'messge': 'Lololo'},
        {x: '40-65', y: 0, z: 2, a: 4, 'messge': 'Lololo'},
        {x: '65 +', y: 2, z: 4, a: 3, 'messge': 'Lololo'}
      ],
      xkey: 'x',
      ykeys: ['y', 'z', 'a'],
      labels: ['Telenor', 'M-tel', 'Vivacom'],
      barColors: ['#FF3835','#515151','#6C76FF']
    }
	 */
	
	var barData =  JSON.parse('{{bar_data_json}}')
	barData.element = 'barChart{{scope}}'

    Morris.Bar(barData).on('click', function(i, row){
		 var dataPie = [
		  { label: "Telenor", color:'#515151', data: row.telenor},
		  { label: "Mtel", color:'#FF3835', data: row.mtel},
		  { label: "Vivacom", color:'#6C76FF', data: row.vivacom}
		];

		 $.plot('#labelBarChartModalMessage{{scope}}', dataPie, {
		  series: {
		      pie: {
		          show: true
		      }
		  },
		  legend: {
		      show: false
		  }
		});
    	$("#labelBarChartModalHeader{{scope}}").text(row.age_group);
    	$("#labelBarChartModal{{scope}}").modal('show');
    });



});
</script>
