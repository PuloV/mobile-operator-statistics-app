<canvas id="chartGraph{{scope}}" width="1000" height="150"></canvas>

<script type="text/javascript">
jQuery(document).ready(function(){
  /* 
    DEFAULT STRUCTURE SHOULD BE
    labels: ["16-20", "20-30", "30-40", "40-65", "65+"]    
    data: [65, 59, 90, 81, 56]
  */
 var graphLabels = JSON.parse('{{labels_json}}');

 var graphData = JSON.parse('{{values_json}}').map(function(item) {
    return parseFloat(item);
  })

  var ctx = $("#chartGraph{{scope}}").get(0).getContext("2d");
  
  console.log('label', graphLabels);
  console.log('data', graphData);

  var data = {
    labels: graphLabels,
    datasets: [
        {
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            data: graphData
        }
    ]          
  };  

  var myNewChart = new Chart(ctx).Line(data);
});
</script>