{{header}}
<div id="content">
  <div class="panel chart-title">
    <h3><span class="fa fa-pie-chart"></span> {{frame_title}}</h3>
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
                  {{age_group_chart}}
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
                      {{gender_group_chart}}
                </div>
          </div>
          <div class="panel">
               <div class="panel-heading-white panel-heading text-center">
                    <h4>Average</h4>
                  </div>
                  <div class="panel-body" style="padding-top: 21px;padding-bottom: 21px;">
                    
                    <div class="col-md-12">
                      <div class="col-md-6">
                        Age:
                      </div>
                      <div class="col-md-6">
                        {{average_age}}
                      </div>
                    </div>  

                    <div class="col-md-12">
                      <div class="col-md-6">
                        Tax:
                      </div>
                      <div class="col-md-6">
                        {{average_tax_amount}}
                      </div>
                    </div> 

                    <div class="col-md-12">
                      <div class="col-md-6">
                        Minutes:
                      </div>
                      <div class="col-md-6">
                        {{average_minutes}}
                      </div>
                    </div> 

                    <div class="col-md-12">
                      <div class="col-md-6">
                        Megabytes:
                      </div>
                      <div class="col-md-6">
                        {{average_megabytes}}
                      </div>
                    </div> 

                    <div class="col-md-12">
                      <div class="col-md-6">
                        SMS:
                      </div>
                      <div class="col-md-6">
                        {{average_sms_count}}
                      </div>
                    </div> 

                </div>
          </div>  
        </div>
    </div>
  </div>              
  <!-- <div class="col-md-12 padding-5"> -->
    <div class="col-md-12 padding-5">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4> Average Minutes</h4>
                </div>
                <div class="panel-body">
                    {{minutes_chart_graph}}
                </div>
          </div>  
        </div>
    </div>

    <div class="col-md-12 padding-5">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>Average Tax</h4>
                </div>
                <div class="panel-body">
                     {{tax_chart_graph}}
                </div>
          </div>  
        </div>
    </div>

    <div class="col-md-12 padding-5">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>Average Megabytes</h4>
                </div>
                <div class="panel-body">
                     {{megabytes_chart_graph}}
                </div>
          </div>  
        </div>
    </div> 
    
    <div class="col-md-12 padding-5">
        <div class="col-md-12">
           <div class="panel">
               <div class="panel-heading panel-heading-white text-center">
                  <h4>Average SMS</h4>
                </div>
                <div class="panel-body">
                     {{sms_chart_graph}}
                </div>
          </div>  
        </div>
    </div>    
  <!-- </div> -->
 </div>
{{footer}}