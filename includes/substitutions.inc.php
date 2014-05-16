<?php

include_once "classes/substitutions.class.php";

$tpl->assign("Title", "Vertretungsplan");
$tpl->addCss(array("name" => "substitutions.css"));

$substitution = new substitutions($user);

if ($user->hasRight("Substitutions") || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin") || $user->hasRight("God")) {
    if ($_GET["mode"] == "edit" && $_POST["upload"]) {
        if (!$substitution->insertSubstitution($_POST["lesson"], $_POST["teacher"], $_POST["substitute"], $_POST["subject"], $_POST["type"], $_POST["comments"], $_POST["date"])) {
            $tpl->assign("Errors", $substitution->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    } elseif ($_GET["mode"] == "edit" && is_numeric($_GET["delete"])) {
      $substitution->deleteSubstitution($_GET["delete"]);
      header("LOCATION: ?screen=substitutions&mode=edit");
      } elseif ($_GET["mode"] == "edit" && $_POST["edit"]) {
        if (!$substitution->updateSubstitutions($_POST["id"], $_POST["lesson"], $_POST["teacher"], $_POST["substitute"], $_POST["subject"], $_POST["type"], $_POST["comments"], $_POST["date"])) {
            $tpl->assign("Errors", $substitution->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    }
}


$substitution->setSubstitutions();


$tpl->assign("Weekdays", array('Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Sonnabend'));

if ($user->hasRight("Substitutions") || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin") || $user->hasRight("God")) {
    $tpl->assign("EditLink", "<a href='?screen=substitutions&mode=edit'>Bearbeiten</a>");
}else{
    $tpl->assign("EditLink", "");
}

if ($_GET["mode"] == "edit" && ($user->hasRight("Substitutions") || $user->hasRight("SchoolAdmin") || $user->hasRight("ClassAdmin") || $user->hasRight("God"))) {
    $substitution->setSubjects();
    $substitution->setSubstitutionTypes();

    $tpl->assign("Subjects", $substitution->getSubjects());
    $tpl->assign("Types", $substitution->getSubstitutionTypes());
    
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
