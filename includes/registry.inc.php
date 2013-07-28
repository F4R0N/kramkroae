<?php
    if($_POST["registerSubmit"] == "1"){
        echo "<pre>";
        print_r($_POST);    
        echo "</pre>"; 
        
        $tpl->addMainTemplate("registryFinished.tpl.php");
        $tpl->addCss(array("name" => "registryFinished.css"));
        $tpl->assign("Errors", $succeeded);
        $tpl->assign("Title", "Abgeschlossene Registrierung");
        
    } else {
        include_once 'classes/registry.class.php';

        $registry = new registry();

        $tpl->addMainTemplate("registry.tpl.php");
        $tpl->addCss(array("name" => "registry.css"));
        $tpl->assign("Errors", $succeeded);
        $tpl->assign("Title", "Registrierung");
    }
?>
