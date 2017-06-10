<?php

class ChartUtil {
	private static $_used_scopes = array();

    public static function getChart($type,$data){
        $chart_data = self::getChartData($type, $data);
        $template   = self::getChartTemplate($type);
        return Template::get($template, $chart_data);
    }

    public static function getChartTemplate($type){
        $template = NULL;

        switch ($type) {
            case 'month_respondend_pie':
            case 'gender_group_chart':
                $template = 'chart_pie';
                break;

            case 'mobile_operator_chart':
                $template = 'chart_label_pie';
                break;

            case 'age_group_chart':
                $template = 'chart_info_pie';
                break;

            case 'month_respondend_area':
                $template = 'chart_area';
                break;

            case 'minutes_chart_graph':
            case 'megabytes_chart_graph':
            case 'sms_chart_graph':
            case 'tax_chart_graph':
                $template = 'chart_graph';
                break;
            
            default:
                $template = $type;
                break;
        }

        return $template;
    }

    public static function getScope(){
        do{
            $scope = rand(0,100);
        } while (in_array($scope, self::$_used_scopes));

        self::$_used_scopes[] = $scope;

        return $scope;
    }

    public static function getChartData($template, $data) {
        $chart_data = array();
        $chart_data['scope'] = self::getScope();

        switch ($template) {
            case 'month_respondend_area':

                $area_data = array();
                $area_data['data'] = $data;
                $area_data['xkey'] = 'month';
                $area_data['ykeys'] = array('people');
                $area_data['labels'] = ['Respondents'];
                $area_data['lineColors'] = ['#444'];
                $chart_data['area_data_json'] = json_encode($area_data);
                break;
            
            case 'month_respondend_pie':
            case 'gender_group_chart':
                $area_data = array_map( 
                    function($entry){
                        $entry_data = array();
                        $entry_data['value'] = $entry['people'];
                        $entry_data['color'] = $entry['gender'] == 'M' ? '#5BAABF' : '#4ED18F';
                        $entry_data['highlight'] = '#15BA67';
                        $entry_data['label'] = $entry['gender'] == 'M' ? 'Male' : 'Female';
                        return $entry_data;
                    },
                    $data
                );

                $chart_data['pie_data_json'] = json_encode($area_data);
                break;            

            case 'mobile_operator_chart':
                $total_users = array_reduce(
                    $data, 
                    function($total, $item){
                        return $total + $item['people'];
                    },
                    0
                );

                $operator_data = array_map( 
                    function($entry) use ($total_users) {
                        $entry_data             = array();

                        $people_count           = $entry['people'];
                        $percent_value          = $people_count * 100 / $total_users;
                        
                        $entry_data['value']    = round($percent_value, 2);

                        switch ($entry['mobile_operator']) {
                            case 'mtel':
                                $entry_data['label'] = 'M-tel';
                                break;

                            case 'vivacom':
                                $entry_data['label'] = 'Vivacom';
                                break;
                            
                            case 'telenor':
                                $entry_data['label'] = 'Telenor';
                                break;
                            
                            default:
                                $entry_data['label'] = $entry['mobile_operator'];
                                break;
                        }

                        $entry_data['modal_message'] = sprintf(
                            '%d from %d people are using %s. This is %s percent of all.',
                            $people_count,
                            $total_users,
                            $entry_data['label'],
                            $entry_data['value']
                        );

                        return $entry_data;
                    },
                    $data
                );
                
                $area_data = array();
                $area_data['data']          = $operator_data;
                $area_data['colors']        = array('#FF3835','#515151','#6C76FF');

                $chart_data['pie_data_json'] = json_encode($area_data);
                $chart_data['modal_header']  = 'Mobile Operator Users';
                break;


            case 'age_group_chart':
                $total_users = array_reduce(
                    $data, 
                    function($total, $item){
                        return $total + $item['people'];
                    },
                    0
                );

                $area_data = array_map( 
                    function($entry) use ($total_users) {
                        $entry_data             = array();

                        $people_count           = $entry['people'];
                        $percent_value          = $people_count * 100 / $total_users;
                        
                        $entry_data['data']    = round($percent_value, 2);

                        switch ($entry['age_group']) {
                            case '16-20':
                                $entry_data['label'] = $entry['age_group'];
                                $entry_data['color'] = '#8C54CA';
                                break;

                            case '20-30':
                                $entry_data['label'] = $entry['age_group'];
                                $entry_data['color'] = '#7C34CF';
                                break;
                            
                            case '30-40':
                                $entry_data['label'] = $entry['age_group'];
                                $entry_data['color'] = '#6C24CA';
                                break;

                            case '40-65':
                                $entry_data['label'] = $entry['age_group'];
                                $entry_data['color'] = '#58B2F4';
                                break;
                            
                            case '65+':
                                $entry_data['label'] = $entry['age_group'];
                                $entry_data['color'] = '#BBE0E9';
                                break;
                            
                            default:
                                $entry_data['label'] = 'Unknown';
                                $entry_data['color'] = '#FF0000';
                                break;
                        }

                        return $entry_data;
                    },
                    $data
                );
                
                $chart_data['pie_data_json'] = json_encode($area_data);
                break;

                case 'minutes_chart_graph':
                case 'megabytes_chart_graph':
                case 'sms_chart_graph':
                case 'tax_chart_graph':
                
                    switch ($template) {
                        case 'minutes_chart_graph':
                            $chart_key = 'average_mins';
                            break;

                        case 'megabytes_chart_graph':
                            $chart_key = 'average_mb';
                            break;

                        case 'sms_chart_graph':
                            $chart_key = 'average_sms';
                            break;

                        case 'tax_chart_graph':
                            $chart_key = 'average_tax';
                            break;
                    }

                    $labels     = array();
                    $values     = array();

                    foreach ($data as $key => $value) {
                        $labels[] = $value['age_group'];
                        $values[] = $value[$chart_key];
                    }

                    $chart_data['labels_json'] = json_encode($labels);
                    $chart_data['values_json'] = json_encode($values);
                    break;
            
            default:
                # code...
                break;
        }

        return $chart_data;
    }
}