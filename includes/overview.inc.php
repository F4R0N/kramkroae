<?php
/*
 * @TODO
 * 
 * ADD MetaTag prefetch: screen=homework
 * 
 */



$tpl->addCss(array("name" => "startPage.css"));

setlocale(LC_TIME, "de_DE");

$tomorrowDate = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
$tomorrowDate = date("d. m. Y", $tomorrowDate);

$tomorrowDay = strftime("%A", $tomorrowDate);

$tpl->assign("tomorrowDate", $tomorrowDate);
$tpl->assign("tomorrowDay", $tomorrowDay);

$tpl->addMainTemplate("overview.tpl.php");

?>
