<div id="infoPieChart{{scope}}" style="height:300px;"></div>

<script type="text/javascript">
jQuery(document).ready(function(){
  /* 
    DEFAULT STRUCTURE SHOULD BE
  var dataPie = [
      { label: "16-20", color:'#8C54CA', data: 210},
      { label: "20-30", color:'#7C34CF', data: 190},
      { label: "30-40", color:'#6C24CA', data: 110},
      { label: "40-65", color:'#58B2F4', data: 100},
      { label: "65+", color:'#BBE0E9', data: 50}
  ];
  */
 var pieChartData = JSON.parse('{{pie_data_json}}').map(function(item) {
    var parsedValue = item;
    parsedValue.data = parseInt(item.data);
    return parsedValue;
  })
  
  var dataPie = JSON
  $.plot('#infoPieChart{{scope}}', pieChartData, {
      series: {
          pie: {
              show: true
          }
      },
      legend: {
          show: false
      }
  });
});
</script>