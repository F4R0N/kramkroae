<?php

class template {

    private $CSSs;
    private $JSs;
    private $VARS;
    private $mainTemplates;

    public function __construct() {
        return true;
    }

    function assign($key, $value) {
        $this->VARS[$key] = $value;
    }

    function display($templateName) {
        if (is_file("templates/" . $templateName)) {
            $VARS = $this->VARS;
            $CSSs = $this->CSSs;
            $JSs = $this->JSs;
            $TPLs = $this->mainTemplates;
            include_once "templates/" . $templateName;
        } else {
            die("ERROR");
        }
    }
    
    function addCss($CSS){
        $this->CSSs[] = $CSS;
    }
    
    function addJS($JS){
        $this->JSs[] = $JS;
    }
    
    function addMainTemplate($templatePath){
        $this->mainTemplates[] = "includes/templates/" . $templatePath;
    }
}

?>
