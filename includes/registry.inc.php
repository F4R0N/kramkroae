<?php

    include_once 'classes/registry.class.php';
    
    $registry = new registry();
    
    $tpl->addMainTemplate("registry.tpl.php");
    $tpl->addCss(array("name" => "registry.css"));
    
    $tpl->assign("Title", "Registrierung");
?>
