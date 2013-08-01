<?php

include_once 'classes/schedule.class.php';
$schedule = new schedule($user);
if($user->hasRight("Schedule")){
    $tpl->assign("EditLink", "| <a href='?screen=schedule&mode=edit'>Bearbeiten</a>");
    if(isset($_GET["mode"]) && $_GET["mode"] == "edit"){
        $tpl->addMainTemplate("editSchedule.tpl.php");
        if($schedule->checkScheduleAvail()){
            echo "Hi";
        }else{
            echo "LoL";
        }
    }
}
if($_GET["mode"] != "edit"){
    $tpl->addMainTemplate("schedule.tpl.php");
    $tpl->addCss(array("name" => "schedule.css"));
    $tpl->assign("Title", "Stundenplan");
    $tpl->assign("scheduleHead", $schedule->getScheduleThead());
    $tpl->assign("scheduleBody", $schedule->getSchedule());
    $tpl->assign("maxLesson", $schedule->getMaxLesson());
    $tpl->assign("maxDay", $schedule->getMaxDay());
    //$tpl->assign("time", $schedule->);
}
?>
