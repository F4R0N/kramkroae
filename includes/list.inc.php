<?php
    $tpl->addMainTemplate("list.tpl.php");
    
    $tpl->addCss(array("name" => "list.css"));
    
    $tpl->assign("Title", "Klassenliste");
    $tpl->assign("Cm", $user->getClassmates());
?>