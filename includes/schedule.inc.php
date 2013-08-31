<?php
include_once 'classes/schedule.class.php';
$schedule = new schedule($user);
$tpl->assign("scheduleHead", $schedule->getScheduleThead());
$tpl->assign("scheduleBody", $schedule->getSchedule());
$tpl->assign("lesson", $schedule->getLessonsTime());
$tpl->addCss(array("name" => "schedule.css"));
if($user->hasRight("Schedule")){
    $tpl->assign("EditLink", "| <a href='?screen=schedule&mode=edit'>Bearbeiten</a>");
    if(isset($_GET["mode"]) && $_GET["mode"] == "edit"){
        $tpl->addMainTemplate("editSchedule.tpl.php");
    }
}
if(!isset($_GET["mode"])){
    if($schedule->checkScheduleAvail()){
        if(isset($_GET["lesson"]) && isset($_GET["time"]) && isset($_GET["subject"])){
        }
        $tpl->addMainTemplate("schedule.tpl.php");
        $tpl->assign("Title", "Stundenplan");
        $tpl->assign("maxLesson", $schedule->getMaxLesson());
        $tpl->assign("maxDay", $schedule->getMaxDay());
    }else{
        if($user->hasRight("Schedule")){
            $tpl->addMainTemplate("editschedule.tpl.php");
        }else{
            $tpl->addMainTemplate("noSchedule.tpl.php");
        }
    }
}
if($_GET["mode"] == "new"){
    echo "<h1>1</h1>";
}
?>