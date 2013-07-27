<?php

    include_once 'registry.class.php';
    
    //$registry = new registry();
    
    $tpl->addMainTemplate("registry.tpl.php");
    $tpl->addCss(array("name" => "registry.css"));
    
    $tpl->assign("Title", "Registrierung");
?>
