<?php
    include_once 'classes/infdev.class.php';
    
    $tpl->assign("Title", "Entwicklungsinformationen");
            
    $tpl->assign("version", CURRENT_BUILD);
    $tpl->assign("olderVersion", $row["Version"]);
    $tpl->assign("olderDescription", $row["Description"]);
    $tpl->addMainTemplate("infdev.tpl.php");
?>
