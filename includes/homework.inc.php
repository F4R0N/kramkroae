<?php

include_once "classes/homeworks.class.php";

$tpl->assign("Title", "Hausaufgaben");
$tpl->addCss(array("name" => "homework.css"));

$homeworks = new homeworks($user);
$homeworks->deleteHomeworkByDate();

if ($user->hasRight("Homeworks") || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin") || $user->hasRight("God")) {
    if ($_GET["mode"] == "edit" && $_POST["upload"]) {
        if (!$homeworks->insertHomework($_POST["homework"], $_POST["start"], $_POST["end"], $_POST["subject"])) {
            $tpl->assign("Errors", $homeworks->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    } elseif ($_GET["mode"] == "edit" && is_numeric($_GET["delete"])) {
        $homeworks->deleteHomework($_GET["delete"]);
        header("LOCATION: ?screen=homework&mode=edit");
    } elseif ($_GET["mode"] == "edit" && $_POST["edit"]) {
        if (!$homeworks->editHomeworks($_POST["id"], $_POST["homework"], $_POST["start"], $_POST["end"], $_POST["subject"])) {
            $tpl->assign("Errors", $homeworks->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    }
}

$homeworks->setHomeworks();
$tpl->assign("Weekdays", array('Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Sonnabend'));
if ($user->hasRight("Homeworks") || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin") || $user->hasRight("God")) {
    $tpl->assign("EditLink", "<a href='?screen=homework&mode=edit'>Bearbeiten</a>");
}else{
    $tpl->assign("EditLink", "");
}

if ($_GET["mode"] == "edit" && ($user->hasRight("Homeworks")  || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin")|| $user->hasRight("God"))) {
    $homeworks->setSubjects();

    if ($homeworks->getCountOfHomeworks() !== 0) {
        $tpl->assign("Homeworks", $homeworks->getHomeworks());
        $tpl->addMainTemplate("edithomework.tpl.php");
    }
    $tpl->assign("Subjects", $homeworks->getSubjects());
    $tpl->addMainTemplate("uploadhomework.tpl.php");
} elseif ($homeworks->getCountOfHomeworks() !== 0) {
    $tpl->assign("Homeworks", $homeworks->getHomeworks());
    $tpl->assign("LastUpdate", $homeworks->getLastUpdate());
    $tpl->assign("UpdatedBy", new user($homeworks->getLastUpdaterID()));
    $tpl->addMainTemplate("homework.tpl.php");
} else {
    $tpl->addMainTemplate("nohomework.tpl.php");
}
?>
