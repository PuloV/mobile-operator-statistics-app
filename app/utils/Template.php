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

    public static function get($id, $vars = array()) {
        Template::$VARS = $vars;

        $TEMPLATES = Template::getTemplates();

        $url = $TEMPLATES[$id];

        // get file contents, if there is no cache
        ob_start();
        include($url);
        $v = ob_get_contents();
        ob_end_clean();

        return preg_replace_callback('!\{\{(\w+)\}\}!', "Template::replaceValue",  $v);
    }


    public static function getTemplates() {

        return array(
            'error_404' => TEMPLATES . 'errors/404.html',
            'error_500' => TEMPLATES . 'errors/500.html',
        );

    }

}

?>
