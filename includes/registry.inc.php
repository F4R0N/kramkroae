<?php

    echo "<pre>";
    print_r($_POST);    
    echo "</pre>";
    include_once 'classes/registry.class.php';

    $registry = new registry();

    if (isset($_POST["registerSubmit"])) {
        $succeeded = $registry->register();
        if($succeeded){
            $tpl->addMainTemplate("registry.tpl.php");
            $tpl->addCss(array("name" => "registry.css"));
            $tpl->assign("Errors", $succeeded);
            $tpl->assign("Title", "Registrierung");
        }else{
            $tpl->addMainTemplate("registryFinished.tpl.php");
            $tpl->addCss(array("name" => "registryFinished.css"));
            $tpl->assign("Title", "Abgeschlossene Registrierung");
        }

    } else {
            $tpl->addMainTemplate("registry.tpl.php");
            $tpl->addCss(array("name" => "registry.css"));
            $tpl->assign("Title", "Registrierung");
        }
    
?>
