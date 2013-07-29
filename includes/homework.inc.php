<?php

include_once "classes/homeworks.class.php";

$tpl->assign("Title", "Hausaufgaben");
$tpl->addCss(array("name" => "hausaufgaben.css"));


$homeworks = new homeworks($user);
$homeworks->setHomeworks();
$tpl->assign("Weekdays", array('Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Sonnabend'));


if ($_GET["mode"] == "edit") {
    
    $tpl->addMainTemplate("edithomework.tpl.php");
} elseif ($homeworks->getCountOfHomeworks() !== 0) {
    if ($user->hasRight("Homeworks")) {
        $tpl->assign("EditLink", "| <a href='?screen=homework&mode=edit'>Bearbeiten</a>");
    }
    $tpl->assign("Homeworks", $homeworks->getHomeworks());
    $tpl->assign("LastUpdate", $homeworks->getLastUpdate());
    $tpl->assign("UpdatedBy", new user($homeworks->getLastUpdaterID()));
    $tpl->addMainTemplate("homework.tpl.php");
} else {
    $tpl->addMainTemplate("nohomework.tpl.php");
}
?>
