<?php
session_start();

require_once "config.php";
require_once "includes/classes/template.class.php";
require_once "includes/classes/user.class.php";

if(!isset($_SESSION["UserID"])){
    $user = new user(0);
    $user->login("mail@fabian1998.de", "asdert");
    exit;
}

$user = new user($_SESSION["UserID"]);
$user->updateLastAction();

if( $_GET["logout"] ){
    $user->logout();
    exit;
}

$tpl = new template();

// add CSS

$normal["name"] = "style.css";
$tpl->addCss($normal);

$handheld["name"] = "handheld.css";
$handheld["media"] = "handheld";
$tpl->addCss($handheld);

$iPhone["name"] = "handheld.css";
$iPhone["media"] = "only screen and (max-device-width: 480px)";
$tpl->addCss($iPhone);

// add Js
$tpl->addJS(array("path" => "http://code.jquery.com/jquery-1.9.1.js"));
$tpl->addJS(array("path" => "js/mainmenu.js"));

// add Variables

$tpl->assign("Title", "Startseite");
$tpl->assign("FirstName", $user->getFirstName());
$tpl->assign("LastName", $user->getLastName());
$tpl->assign("GamesCount", $user->getSSPESRequests());
$tpl->assign("MessagesCount", $user->getUnreadMessages());
$profileImagePath = PATH_TO_PROFIL_IMAGES . $user->getID() . ".png";

/*if(file_exists($profileImagePath)){*/
    $tpl->assign("PathToUserImage", $profileImagePath);
/*} else {
    $tpl->assign("PathToUserImage", "http://fabian1998.de/ha/uploads/kein-Bild.jpg");
}*/


// add maincontent

$path = "includes/" . $_GET["screen"] . ".inc.php";
if( file_exists($path) ){
    include $path;
} else {
    include "includes/overview.inc.php";
}

// display the site

$tpl->display("siteLoggedOn.tpl.php");

?>