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
                $template = 'chart_pie';
                break;

            case 'mobile_operator_chart':
                $template = 'chart_label_pie';
                break;

            case 'month_respondend_area':
                $template = 'chart_area';
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
            
            default:
                # code...
                break;
        }

        return $chart_data;
    }
}