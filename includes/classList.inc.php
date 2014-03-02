<?php
    $tpl->addMainTemplate("classList.tpl.php");
    
    $tpl->addCss(array("name" => "list.css"));
    
    $tpl->assign("Title", "Meine Klassenkameraden");
    $tpl->assign("Cm", $user->getClassmates());
?>
