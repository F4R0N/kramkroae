<?php

include_once 'classes/overview.class.php';

$overview = new overview();

setlocale(LC_TIME, "de_DE");

$tpl->assign("tomorrowDate", date("d. m. Y", $overview->getTmrw()));
$tpl->assign("tomorrowDay", strftime("%A", $overview->getTmrw()));
$tpl->assign("countHW", count($overview->getTmrwHomeworks()));

if (count($overview->getTmrwHomeworks()) >= 1) {
    $Ends = array();
    $Subs = array();
    $homes = array();

    foreach ($overview->getTmrwHomeworks() as $theHW) {
        $homeworkEnd = date("d.m.Y", strtotime($theHW->End));
        $subID = $overview->getSubjectByID($theHW->SubjectID);
        $homework = $theHW->Homework;

        array_push($Ends, $homeworkEnd);
        array_push($Subs, $subID);
        array_push($homes, $homework);
    }

    $tpl->assign("hwEnd", $Ends);
    $tpl->assign("hwSub", $Subs);
    $tpl->assign("homework", $homes);
}else{
    $tpl->assign("countHW", 0);
}

$tpl->addMainTemplate("overview.tpl.php");
$tpl->addCss(array("name" => "startPage.css"));
?>
