<?php

include_once 'classes/overview.class.php';
include_once 'classes/homeworks.class.php';


$overview = new overview();

setlocale(LC_TIME, "de_DE");

$tpl->assign("tomorrowDate", date("d. m. Y", $overview->getTmrw()));
$tpl->assign("tomorrowDay", strftime("%A", $overview->getTmrw()));
$tpl->assign("countHW", count($overview->getTmrwHomeworks()));
$tpl->assign("nextEvents", $overview->getNextEvents());
$tpl->assign("countEvents", count($overview->getNextEvents()));

if (count($overview->getTmrwHomeworks()) >= 1) {
    $Subs = array();
    $homes = array();

    foreach ($overview->getTmrwHomeworks() as $theHW) {
        $subID = htmlentities($overview->getSubjectByID($theHW->SubjectID));
        $homework = htmlentities($theHW->Homework);

        array_push($Subs, $subID);
        array_push($homes, $homework);
    }

    $tpl->assign("hwSub", $Subs);
    $tpl->assign("homework", $homes);
}

$tpl->addMainTemplate("overview.tpl.php");
$tpl->addCss(array("name" => "overview.css"));
?>
