<?php
/*
 * @TODO
 * 
 * ADD MetaTag prefetch: screen=homework
 * 
 */

include_once 'classes/overview.class.php';

$overview = new overview();

setlocale(LC_TIME, "de_DE");

$tpl->assign("tomorrowDate", date("d. m. Y", $overview->getTmrw()));
$tpl->assign("tomorrowDay", strftime("%A", $overview->getTmrw()));
$tpl->addMainTemplate("overview.tpl.php");
$tpl->addCss(array("name" => "startPage.css"));

?>
