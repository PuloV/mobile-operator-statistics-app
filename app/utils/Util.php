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
}