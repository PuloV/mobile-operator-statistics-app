<center>
  <canvas class="pieChart{{scope}}"></canvas>
</center>
                              
<script type="text/javascript">
jQuery(document).ready(function(){
  /*
    DEFAULT STRUCTURE SHOULD BE 
    [
      {
          value: 120,
          color:"#4ED18F",
          highlight: "#15BA67",
          label: "Female"
      },
      {
          value: 100,
          color: "#5BAABF",
          highlight: "#15BA67",
          label: "Male"
      }

    ];
   */
  var pieChartData = JSON.parse('{{pie_data_json}}').map(function(item) {
    var parsedValue = item;
    parsedValue.value = parseInt(item.value);
    return parsedValue;
  })
  
  var pieChartContext = $(".pieChart{{scope}}")[0].getContext("2d");
  var genderPieChart = new Chart(pieChartContext).Pie(pieChartData, {
      responsive : true,
      showTooltips: true
  });




});
</script>