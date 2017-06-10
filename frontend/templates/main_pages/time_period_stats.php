{{header}}
<div id="content">
  <div class="panel chart-title">
    <h3><span class="fa fa-pie-chart"></span> Monthly</h3>
  </div>
  <div class="col-md-12 padding-5">
    <div class="col-md-3">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>Mobile Operator</h4>
                </div>
                <div class="panel-body">
                    {{mobile_operator_chart}}
                </div>
          </div>  
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>Age Groups</h4>
                </div>
                <div class="panel-body">
                  <div id="pie-chart" style="height:300px;"></div>
                </div>
          </div>  
        </div>
    </div> 
    <div class="col-md-3">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading-white panel-heading text-center">
                    <h4>Gender</h4>
                  </div>
                  <div class="panel-body">
                      
                      <canvas class="genderPieChart" ></canvas>
                      </center>
                </div>
          </div>  
        </div>
    </div>
  </div>              
  <div class="col-md-12 padding-5">
    <div class="col-md-3">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>Minutes</h4>
                </div>
                <div class="panel-body">
                    <canvas id="minutesUsageGroupedByAge" width="150" height="150"></canvas>
                </div>
          </div>  
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>Megabytes</h4>
                </div>
                <div class="panel-body">
                  <div id="pie-chart" style="height:300px;"></div>
                </div>
          </div>  
        </div>
    </div> 
    <div class="col-md-3">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>SMS</h4>
                </div>
                <div class="panel-body">
                  <div id="pie-chart" style="height:300px;"></div>
                </div>
          </div>  
        </div>
    </div>
  </div>
 </div>
{{footer}}