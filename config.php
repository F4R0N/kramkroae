<?php
require_once "../private/privates.php";

define("CURRENT_BUILD", "alpha-7");
define("PATH_TO_PROFIL_IMAGES", "/images/uploads/");
define("AGB_VERSION", 1);

define("UMLAUT_SMALL_A", "Ã¤");
define("UMLAUT_SMALL_O", "Ã¶");
define("UMLAUT_SMALL_U", "Ã¼");

$allowedOnlinePages = array(
    "homework",
    "overview",
    "infdev",
    "schedule",
    "hwhelper",
    "substitutions",
    "calendar",
    "settings",
    "list",
    "terms",
    "legNotice",
    "profile"
);
$allowedOfflinePages = array(
    "login",
    "registry",
    "terms",
    "legNotice"
);

?>
