<?php
    $tpl->addMainTemplate("schoolList.tpl.php");
    
    $tpl->addCss(array("name" => "list.css"));
    
    $tpl->assign("Title", "Angemeldete Klassen auf meiner Schule");
    $tpl->assign("Classes", $user->getClassesFromSchool());
?>
