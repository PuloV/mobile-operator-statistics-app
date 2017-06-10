<?php
class Template {

    protected static $TEMPLATES;
    public static $VARS;

    public static function replaceValue($matches) {

        if (empty(Template::$VARS[$matches[1]])) {
            Template::$VARS[$matches[1]] = "{{".$matches[1]."}}";
        }
        return Template::$VARS[$matches[1]];

    }

    public static function getAdditionalDataForTemplate($template, $vars){
        switch ($template) {
            case 'header':

                $vars['head_menu']  = Template::get('head_menu', array(), false);
                $vars['left_menu']  = Template::get('left_menu', array(), false);
                break;
            case 'footer':
            case 'head_menu':
            case 'left_menu':
                // nothing for now
                break;
            
            default:
                $vars['header']     = Template::get('header', array());
                $vars['footer']     = Template::get('footer', array());
                break;
        }
        return $vars;
    }

    public static function get($id, $vars = array()) {

        $vars = Template::getAdditionalDataForTemplate($id, $vars);
        
        Template::$VARS = $vars;

        $TEMPLATES = Template::getTemplates();

        
        $template = $TEMPLATES[$id];

        // get file contents, if there is no cache
        ob_start();
        include($template);
        $v = ob_get_contents();
        ob_end_clean();

        return preg_replace_callback('!\{\{(\w+)\}\}!', "Template::replaceValue",  $v);
    }


    public static function getTemplates() {

        return array(
            'error_404'     => TEMPLATES . 'errors/404.html',
            'error_500'     => TEMPLATES . 'errors/500.html',
            'header'        => TEMPLATES . 'main_pages/header.php',
            'footer'        => TEMPLATES . 'main_pages/footer.php',
            'head_menu'     => TEMPLATES . 'main_pages/head_menu.php',
            'left_menu'     => TEMPLATES . 'main_pages/left_menu.php',
            'main_stats'    => TEMPLATES . 'main_pages/main_stats.php',
        );

    }

}

?>
