<?php

include_once "classes/substitutions.class.php";

$tpl->assign("Title", "Vertretungsplan");
$tpl->addCss(array("name" => "substitutions.css"));

$substitution = new substitutions($user);

if ($_GET["mode"] == "edit" && $_POST["upload"]) {
    if (!$substitution->insertSubstitution($_POST["lesson"], $_POST["teacher"], $_POST["substitute"], $_POST["subject"], $_POST["type"], $_POST["comments"], $_POST["date"])) {
        $tpl->assign("Errors", $substitution->getErrors());
        $tpl->addMainTemplate("errors.tpl.php");
    }
} /*elseif ($_GET["mode"] == "edit" && is_numeric($_GET["delete"])) {
    $homeworks->deleteHomework($_GET["delete"]);
    header("LOCATION: ?screen=homework&mode=edit");
} elseif ($_GET["mode"] == "edit" && is_numeric($_POST["edit"])) {
    if (!$homeworks->editHomework($_POST["edit"], $_POST["homework"], $_POST["start"], $_POST["end"], $_POST["subject"])) {
        $tpl->assign("Errors", $homeworks->getErrors());
        $tpl->addMainTemplate("errors.tpl.php");
    }
}*/

 

$substitution->setSubstitutions();


$tpl->assign("Weekdays", array('Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Sonnabend'));

if ($user->hasRight("Substitutions")) {
    $tpl->assign("EditLink", "| <a href='?screen=substitutions&mode=edit'>Bearbeiten</a>");
}

if ($_GET["mode"] == "edit") {
    $substitution->setSubjects();
    $substitution->setSubstitutionTypes();
    
    $tpl->assign("Subjects", $substitution->getSubjects());
    $tpl->assign("Types", $substitution->getSubstitutionTypes());
    
    $tpl->addJS(array("path" => "http://code.jquery.com/ui/1.10.3/jquery-ui.js"));
    $tpl->addJS(array("path" => "js/datepicker.js"));
    $tpl->addCSS(array("name" => "jquery-ui.css"));

    if ($substitution->getCountOfDays() !== 0) {
        $tpl->assign("Dates", $substitution->getSubstitutions());
        $tpl->addMainTemplate("editsubstitutions.tpl.php");
    }
    $tpl->addMainTemplate("uploadsubstitutions.tpl.php");
} elseif ($substitution->getCountOfDays() !== 0) {
    $tpl->assign("Dates", $substitution->getSubstitutions());
    $tpl->assign("LastUpdate", $substitution->getLastUpdate());
    $tpl->assign("UpdatedBy", new user($substitution->getLastUpdaterID()));
    $tpl->addMainTemplate("substitutions.tpl.php");
} else {
    $tpl->addMainTemplate("nosubstitutions.tpl.php");
}
?>
