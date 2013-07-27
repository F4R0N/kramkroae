<?php

include_once 'classes/schedule.class.php';

$schedule = new schedule();

$tpl->addMainTemplate("schedule.tpl.php");

$tpl->addCss(array("name" => "schedule.css"));

$tpl->assign("Title", "Stundenplan");
$tpl->assign("scheduleHead", $schedule->getScheduleThead());
$tpl->assign("scheduleBody", $schedule->getScheduleTbody());
?>
