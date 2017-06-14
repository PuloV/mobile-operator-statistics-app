{{header}}
<div id="content">
  <div class="panel chart-title">
    <h3 style="display: inline-block;padding-right: 50px;">
      <span class="fa fa-pie-chart"></span> {{frame_title}} results from {{from_date}} to {{to_date}}
    </h3>   

    <span class="event-start-input" style="display: inline-block;">
      <form type="GET" id='start_date_form' >
      <input id="start_date" name="start_date" value="{{from_date_value}}" placeholder="Select Start Date" class="edit date" data-format="yyyy-MM-dd" type="text" tabindex='5' />
      </form>
    </span>
    <script type="text/javascript">
      $('#start_date').datepicker({
        format: 'yyyy-mm-dd',
        date: '{{from_date_value}}'
      }).on('change', function(event) {
        // event.preventDefault();
        /* Act on the event */
        $("#start_date_form").submit();
      });
    </script>
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

    <div class="col-md-12 padding-5">
      <div class="col-md-12">
        <div class="panel">
           <div class="panel-heading-white panel-heading">
              <h4>Total Minutes grouped by age for every mobile operator </h4>
            </div>
            <div class="panel-body">
                {{operator_min_grouped_chart}}
            </div>
          </div>
      </div>
    </div> 

    <div class="col-md-12 padding-5">
      <div class="col-md-5">
        <div class="panel">
           <div class="panel-heading-white panel-heading">
              <h4>People grouped by age for every mobile operator </h4>
            </div>
            <div class="panel-body">
                {{operator_grouped_chart}}
            </div>
          </div>
      </div>
      <div class="col-md-7">
        <div class="panel">
           <div class="panel-heading-white panel-heading">
              <h4>Total taxes grouped by age for every mobile operator </h4>
            </div>
            <div class="panel-body">
                {{operator_tax_grouped_chart}}
            </div>
          </div>
      </div>
    </div>     

    <div class="col-md-12 padding-5">
      <div class="col-md-5">
        <div class="panel">
           <div class="panel-heading-white panel-heading">
              <h4>Total SMS grouped by age for every mobile operator </h4>
            </div>
            <div class="panel-body">
                {{operator_sms_grouped_chart}}
            </div>
          </div>
      </div>
      <div class="col-md-7">
        <div class="panel">
           <div class="panel-heading-white panel-heading">
              <h4>Total Mb grouped by age for every mobile operator </h4>
            </div>
            <div class="panel-body">
                {{operator_mb_grouped_chart}}
            </div>
          </div>
      </div>
    </div> 

  <!-- </div> -->
 </div>
{{footer}}