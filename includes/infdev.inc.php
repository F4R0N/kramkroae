<?php
    $tpl->assign("Title", "Entwicklungsinformationen");
            
    $tpl->assign("version", CURRENT_BUILD);
    $tpl->addMainTemplate("infdev.tpl.php");
?>
