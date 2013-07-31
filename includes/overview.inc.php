<?php
/*
 * @TODO
 * 
 * ADD MetaTag prefetch: screen=homework
 * 
 */



$tpl->addCss(array("name" => "startPage.css"));

$morgen = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
$morgen = date("d. m. Y", $morgen);

$tpl->assign("morgen", $morgen);
$tpl->addMainTemplate("overview.tpl.php");

?>
