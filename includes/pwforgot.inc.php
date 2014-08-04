<?php

include_once 'classes/pwforgot.class.php';
$pwforgot = new pwforgot();

$tpl->assign("Title", "Passwort vergessen?");
$tpl->addCss(array("name" => "LogoutStdStyle.css"));
$tpl->addCss(array("name" => "pwforgot.css"));

if ($_GET["theCode"] == "" || !isset($_GET["theCode"])) {                         // Normal mode
    $tpl->addMainTemplate("pwforgot.tpl.php");
    if (isset($_POST["email"])) {
        if ($_POST["email"] == "") {
            echo "Geben Sie bitte Ihre E-Mail an!";
        } else {
            if($pwforgot->findEmailInDB()){
                $pwforgot->doPWForgotBeforeLink();
                $tpl->assign("firstDisplay", "<a href='index.php?screen=pwforgot&theCode=$pwforgot->lolzRoflxD'>HIER KLICKEN</a>");
            }else{
                $tpl->assign("firstDisplay", "Ihre E-Mail wurde nicht gefunden!");
            }
        }
    }
} else if ($_GET["theCode"] != "" && isset($_GET["theCode"])) {                     // Link mode
    $tpl->addMainTemplate("pwforgotLink.tpl.php");
    if (isset($_POST["PWchange"])) {
        if ($_POST["PWchange"] == "true") {
            $pwforgot->doAllAfterClick($_GET["theCode"], $_POST["newPW"]);
            $tpl->assign("PWStringAfterSuccess", "<br />Passwort erfolgreich ge&auml;ndert!<br/><a href='index.php?screen=overview&email=$pwforgot->email'>Zur&uuml;ck zur Startseite</a>");
        } else {
            echo "Du hast kein Passwort angegeben!";
        }
    }
}
?>