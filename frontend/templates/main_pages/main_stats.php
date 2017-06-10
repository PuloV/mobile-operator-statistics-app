{{header}}
          <!-- start: content -->
            <div id="content">
                <div class="panel chart-title">
                  <h3><span class="fa fa-pie-chart"></span> Respondents</h3>
                </div>
                <div class="col-md-12 padding-0">
                    <div class="col-md-9">
                          <div class="panel" style="padding:10px;">
                             <div class="panel-heading panel-heading-white text-center">
                                <h4>Respondents</h4>
                              </div>
                              <div class="panel-body">
                                  <div id="respondentsAsked"></div>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                             <div class="panel-heading-white panel-heading text-center">
                                <h4>Gender</h4>
                              </div>
                              <div class="panel-body">
                                  <center>
                                  <canvas class="genderPieChart"></canvas>
                                  </center>
                              </div>
                        </div>
                    </div>
                 </div>
               </div>

     <script type="text/javascript">
      jQuery(document).ready(function(){

        Morris.Area({
            element: 'respondentsAsked',
            data: [
               { month: '2016-11', peopleCount: 25},
               { month: '2016-12', peopleCount: 50},               
               { month: '2017-01', peopleCount: 25},
               { month: '2017-02', peopleCount: 50},
               { month: '2017-03', peopleCount: 75},
               { month: '2017-04', peopleCount: 50},
               { month: '2017-05', peopleCount: 75},
               { month: '2017-06', peopleCount: 50},
               { month: '2017-07', peopleCount: 25}
            ],
            xkey: 'month',
            ykeys: ['peopleCount'],
            labels: ['Respondents'],
            lineColors: ['#444']
        });

        var genderPieChartData = [
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
        var genderPieChartContext = $(".genderPieChart")[0].getContext("2d");
        var genderPieChart = new Chart(genderPieChartContext).Pie(genderPieChartData, {
            responsive : true,
            showTooltips: true
        });


 

      });
     </script>
  <!-- end: Javascript -->

  {{footer}}