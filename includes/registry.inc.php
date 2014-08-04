<?php
if($_GET["mode"] == "user" || !isset($_GET["mode"]) || $_GET["mode"] == ""){
    
    include_once 'classes/registry.class.php';
    $registry = new registry();
    if (isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1) {
        if (!$registry->checkIfErrors()) {
            $registry->register();
        }else{
            $tpl->assign("registryFailMessage", "Registrierung fehlgeschlagen");
            //$tpl->assign("Errors", $registry->getErrors());
            $tpl->assign("firstName", htmlentities($_POST["firstName"]));
            $tpl->assign("lastName", htmlentities($_POST["lastName"]));
            if($registry->checkEmail() == false){
               $tpl->assign("email", htmlentities($_POST["email"])); 
            }else{
                $tpl->assign("email", "Bitte eine andere E-Mail benutzen!"); 
            }
            
            //$tpl->addMainTemplate("errors.tpl.php");
            if($_POST["gender"] == 1){
                $tpl->assign("checkedOne", $registry->getCheckedGender(htmlentities($_POST["gender"])));
            }elseif($_POST["gender"] == 0){
                $tpl->assign("checkedZero", $registry->getCheckedGender(htmlentities($_POST["gender"])));
            }
        }
    }
    $tpl->addMainTemplate("registry.tpl.php");
    $tpl->addCss(array("name" => "LogoutStdStyle.css"));
    $tpl->addCss(array("name" => "registry.css"));
    $tpl->assign("Title", "Registrierung");
    
}elseif (isset($_GET["mode"]) && $_GET["mode"] == "school") {
    
    include_once 'classes/schoolRegistry.class.php';
    $schoolRegistry = new schoolRegistry();
    if (isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1) {
        if (!$schoolRegistry->checkIfErrors()) {
            $schoolRegistry->register();
        }else{
            $tpl->assign("Errors", $schoolRegistry->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
        }
    }
    $tpl->addMainTemplate("schoolRegistry.tpl.php");
    $tpl->addCss(array("name" => "LogoutStdStyle.css"));
    $tpl->addCss(array("name" => "schoolRegistry.css"));
    $tpl->assign("Title", "Registrierung f&uuml;r Bildungseinrichtungen");
    $tpl->assign("GStates", $schoolRegistry->getGermanStates());
}
?>