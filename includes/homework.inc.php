<?php

include_once "classes/homeworks.class.php";

$tpl->assign("Title", "Hausaufgaben");
$tpl->addCss(array("name" => "hausaufgaben.css"));

$tpl->assign("LastUpdate", "am 13.3.37 um 13:37 Uhr");
$tpl->assign("UpdatedBy", new user(1));
$homeworks = new homeworks();
$homeworks->setHomeworks();
if ($homeworks->getCountOfHomeworks() !== 0) {
    $tpl->assign("Homeworks", $homeworks->getHomeworks());
    $tpl->addMainTemplate("homework.tpl.php");
} else {
    $tpl->addMainTemplate("nohomework.tpl.php");
}
?>
