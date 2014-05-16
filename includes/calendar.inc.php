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

if ($user->hasRight("Events") || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin") || $user->hasRight("God")) {
    if ($_GET["mode"] == "edit" && $_POST["upload"]) {
        if (!$calendar->addEvent($_POST["Title"], $_POST["Information"], $_POST["Start"], $_POST["End"])) {
            $tpl->assign("Errors", $calendar->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    } elseif ($_GET["mode"] == "edit" && is_numeric($_GET["delete"])) {
        $calendar->deleteEvent($_GET["delete"]);
        header("LOCATION: ?screen=calendar");
    } elseif ($_GET["mode"] == "edit" && $_POST["edit"]) {
        if (!$calendar->editEvent($_POST["ID"], $_POST["Title"], $_POST["Information"], $_POST["Start"], $_POST["End"])) {
            $tpl->assign("Errors", $calendar->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    }
}

if ($user->hasRight("Events") || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin") || $user->hasRight("God")) {
    $tpl->assign("editRight", True);
}

$tpl->assign("Title", "Kalendar");
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