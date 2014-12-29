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
               $tpl->assign("errormessage", htmlentities($_POST["email"])); 
            }else{
                $tpl->assign("errorMessage", "Bitte eine andere E-Mail benutzen!"); 
            }
            if($registry->checkPassword() == true){
                $tpl->assign("errorMessage", "Bitte ein anderes Passwort benutzen!");
            }
            if($registry->checkSchoolID() == true){
                $tpl->assign("schoolErrorMessage", "Bitte eine andere Bildungseinrichtung ausw&auml;hlen!");
            }
            
            //$tpl->addMainTemplate("errors.tpl.php");
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