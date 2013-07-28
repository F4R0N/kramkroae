<?php
require_once "../private/privates.php";

define("CURRENT_BUILD", "alpha-0.1.0.3");
define("PATH_TO_PROFIL_IMAGES", "/images/uploads/");
define("AGB_VERSION", 1);

$allowedOnlinePages = array(
    "homework",
    "overview",
    "infdev",
    "message",
    "schedule",
    "hwhelper",
    " substitutions",
    "calendar",
    "settings",
    "list"
);
$allowedOfflinePages = array(
    "login",
    "registry",
    "terms"
);

?>
