<?php
include_once 'classes/schedule.class.php';
$schedule = new schedule($user);

$tpl->addCss(array("name" => "schedule.css"));
if($user->hasRight("Schedule")){
    $tpl->assign("EditLink", "| <a href='?screen=schedule&mode=edit'>Bearbeiten</a>");
    if(isset($_GET["mode"]) && $_GET["mode"] == "edit"){
        $tpl->addMainTemplate("editSchedule.tpl.php");
        if($_POST["lesson"]){
            $schedule->editSchedule($_POST["lesson"], $_POST["time"], $_POST["subject"]);
        }
    }
}

$tpl->assign("scheduleHead", $schedule->getScheduleThead());
$tpl->assign("scheduleBody", $schedule->getSchedule());
$tpl->assign("lesson", $schedule->getLessonsTime());

if(!isset($_GET["mode"])){
    if($schedule->checkScheduleAvail()){
        $tpl->addMainTemplate("schedule.tpl.php");
        $tpl->assign("Title", "Stundenplan");
        $tpl->assign("maxLesson", $schedule->getMaxLesson());
        $tpl->assign("maxDay", $schedule->getMaxDay());
    }else{
        if($user->hasRight("Schedule")){
            $tpl->addMainTemplate("editSchedule.tpl.php");
        }else{
            $tpl->addMainTemplate("noSchedule.tpl.php");
        }
    }
}
?>