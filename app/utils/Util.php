<?php
/**
* 
*/	
class Util {
	
    public static function dump($var, $title = NULL, $with_trace = true) {
        
        //put shit in a div
        echo "<div class='dump-container'>";
        
        //add the title
        if (!empty($title)) {
            
            echo "<h3>";
            echo $title;
            echo "</h3>";
            
        }
        //dump the content
        fCore::expose($var);
        
        //trace the function
        if ($with_trace) {
            
            echo "<h4>";
            fCore::expose(fCore::backtrace(1));
            echo "</h4>";
            
        }
        
        echo "</div>"; // close div
        
    }

    public static function createMessage($type, $message){
        $template = '';
        switch ($type) {
            case 'error':
                $template = '<div class="alert alert-danger alert-3d alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Error!</strong> %s
                          </div>';
                break; 
            case 'warning':
                $template = '<div class="alert alert-warning alert-3d alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Warning!</strong> %s
                          </div>';
                break; 

            case 'success':
                $template = '<div class="alert alert-success alert-dismissible fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>Success!</strong> %s
                            </div>';
                break;
            
            default:
                # code...
                break;
        }

        return sprintf($template, $message);
    }
}