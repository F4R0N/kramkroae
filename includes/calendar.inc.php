<?php
require_once 'classes/calendar.class.php';
require_once 'classes/month.class.php';

$tpl->assign("days", array(
    "Sonntag",
    "Montag",
    "Dienstag",
    "Mittwoch",
    "Donnerstag",
    "Freitag",
    "Samstag"
        )
);

$tpl->assign("month", array(
    "Januar",
    "Februar",
    "März",
    "April",
    "Mai",
    "Juni",
    "Juli",
    "August",
    "September",
    "Oktober",
    "November",
    "Dezember"
        )
);


if ((checkdate($_GET["month"], 1, $_GET["year"]))) {
    $calendar = new calendar($user, $_GET['month'], $_GET['year']);
} else {
    $calendar = new calendar($user, date('n'), date('Y'));
}



/*
//Ereignisse in Kalender eintragen

$ereignisse = array(array('tag' => 2, 'monat' => 3, 'info_short' => "Englisch-Arbeit", 'info_long' => 'M�ndliche Arbeit', 'style' => ''), array('tag' => 2, 'monat' => 3, 'info_short' => "Deutsch-Arbeit", 'info_long' => 'Schriftliche Arbeit', 'style' => ''));
$ereignisse[] = array('tag' => date('j'), 'monat' => date('n'), 'style' => 'heute');

foreach ($ereignisse as $ereigniss) {
    if ($ereigniss['monat'] == $dieser_monat->monat) {
        $kalender[($dieser_monat->erster_tag + $ereigniss['tag'])]['info_short'] .= $ereigniss['info_short'] . '<br>';
        if ($ereigniss['style'] != '')
            $style = $ereigniss['style'];
        else
            $style = 'termin_data_event';
        $kalender[($dieser_monat->erster_tag + $ereigniss['tag'])]['style'] .= ' ' . $style;
    }
}*/

$tpl->assign("calendar", $calendar->getCalendar());

$tpl->assign("lastMonth", $calendar->getLastMonth()->getMonth());
$tpl->assign("thisMonth", $calendar->getThisMonth()->getMonth());
$tpl->assign("nextMonth", $calendar->getNextMonth()->getMonth());
$tpl->assign("lastYear", $calendar->getLastMonth()->getYear());
$tpl->assign("thisYear", $calendar->getThisMonth()->getYear());
$tpl->assign("nextYear", $calendar->getNextMonth()->getYear());

$tpl->addCss(array("name" => "calendar.css"));
$tpl->addMainTemplate("calendar.tpl.php");

?>