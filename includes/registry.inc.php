<?php
include_once 'classes/registry.class.php';
$registry = new registry();
if($_GET["mode"] == "user" || !isset($_GET["mode"])){
    if (isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1) {
        if (!$registry->checkIfErrors()) {
            $registry->register();
        }else{
            $tpl->assign("Errors", $registry->getErrors());
            $tpl->assign("firstName", htmlentities($_POST["firstName"]));
            $tpl->assign("lastName", htmlentities($_POST["lastName"]));
            $tpl->assign("email", htmlentities($_POST["email"]));
            $tpl->assign("emailCheck", htmlentities($_POST["emailCheck"]));
            
            $tpl->addMainTemplate("errors.tpl.php");
            if($_POST["gender"] == 1){
                $tpl->assign("checkedOne", $registry->getCheckedGender(htmlentities($_POST["gender"])));
            }elseif($_POST["gender"] == 0){
                $tpl->assign("checkedZero", $registry->getCheckedGender(htmlentities($_POST["gender"])));
            }
        }
    }
    $tpl->addMainTemplate("registry.tpl.php");
    $tpl->addCss(array("name" => "registry.css"));
    $tpl->assign("Title", "Registrierung");
}elseif (isset($_GET["mode"]) && $_GET["mode"] == "school") {
    /*if (isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1) {
        if (!$registry->checkIfErrors()) {
            $registry->register();
        }else{
            $tpl->assign("Errors", $registry->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    }*/
    $tpl->addMainTemplate("schoolRegistry.tpl.php");
    $tpl->addCss(array("name" => "schoolRegistry.css"));
    $tpl->assign("Title", "Registrierung f&uuml;r Bildungseinrichtungen");
}
?>