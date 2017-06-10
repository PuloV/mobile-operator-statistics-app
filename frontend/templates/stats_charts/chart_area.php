<div id="chartArea{{scope}}"></div>


<script type="text/javascript">
jQuery(document).ready(function(){

/*
  DEFAULT STRUCTURE SHOULD BE 
  {
      element: 'chartArea{{scope}}',
      data: [
         { month: '2016-11', peopleCount: 25},
         { month: '2016-12', peopleCount: 50},               
         { month: '2017-1', peopleCount: 25},
         { month: '2017-2', peopleCount: 50},
         { month: '2017-3', peopleCount: 75},
         { month: '2017-4', peopleCount: 50},
         { month: '2017-5', peopleCount: 75},
         { month: '2017-6', peopleCount: 50},
         { month: '2017-7', peopleCount: 25}
      ],
      xkey: 'month',
      ykeys: ['peopleCount'],
      labels: ['Respondents'],
      lineColors: ['#444']
  }

*/
  var data = JSON.parse('{{area_data_json}}');
  data.element = 'chartArea{{scope}}';
  // console.log(data);
  Morris.Area(data);

});
</script>

