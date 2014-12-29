<?php

include_once 'classes/overview.class.php';
include_once 'classes/homeworks.class.php';


$overview = new overview();

setlocale(LC_TIME, "de_DE");

$tpl->assign("tomorrowDate", date("d. m. Y", $overview->getTmrw()));
$tpl->assign("tomorrowDay", strftime("%A", $overview->getTmrw()));

$tpl->assign("countTodayHW", count($overview->getTodayHomeworks()));
$tpl->assign("countTmrwHW", count($overview->getTmrwHomeworks()));

$tpl->assign("nextEvents", $overview->getNextEvents());
$tpl->assign("countEvents", count($overview->getNextEvents()));

if (count($overview->getTmrwHomeworks()) >= 1) {
    $tmrwSubs = array();
    $tmrwHW = array();

    foreach ($overview->getTmrwHomeworks() as $theHW) {
        $subID = htmlentities($overview->getSubjectByID($theHW->SubjectID));
        $homework = htmlentities($theHW->Homework);

        array_push($tmrwSubs, $subID);
        array_push($tmrwHW, $homework);
    }

    $tpl->assign("tmrwSubs", $tmrwSubs);
    $tpl->assign("tmrwHW", $tmrwHW);
}

if (count($overview->getTodayHomeworks()) >= 1) {
    $todaySubs = array();
    $todayHW = array();

    foreach ($overview->getTodayHomeworks() as $theHW) {
        $subID = htmlentities($overview->getSubjectByID($theHW->SubjectID));
        $homework = htmlentities($theHW->Homework);

        array_push($todaySubs, $subID);
        array_push($todayHW, $homework);
    }

    $tpl->assign("todaySubs", $todaySubs);
    $tpl->assign("todayHW", $todayHW);
}

$tpl->addMainTemplate("overview.tpl.php");
$tpl->addCss(array("name" => "overview.css"));
?>
