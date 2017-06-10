<div id="labelPieChart{{scope}}" style="height:300px;"></div>

<script type="text/javascript">
jQuery(document).ready(function(){
  Morris.Donut({
    element: 'labelPieChart{{scope}}',
    data: [
      {value: 60, label: 'Mtel'},
      {value: 25, label: 'Telenor'},
      {value: 15, label: 'Vivacom'}
    ],
    colors:['#FF3835','#515151','#6C76FF'],
    formatter: function (x) { return x + "%"}
  }).on('click', function(i, row){
    console.log(i, row);
  });
});
</script>