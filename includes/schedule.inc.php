<?php
    include_once "classes/schedule.class.php";
    
    $schedule = new schedule($user);
    
    $tpl->assign("Title", "Stundenplan");
    $tpl->addMainTemplate("schedule.tpl.php");
    
    $tpl->addCss(array("name" => "style.css"));
    $tpl->addCss(array("name" => "schedule.css"));
?>
