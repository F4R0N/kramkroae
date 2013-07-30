<?php
include_once 'classes/registry.class.php';
$registry = new registry();
if($_GET["mode"] == "user" || !isset($_GET["mode"])){
    if (isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1) {
        if (!$registry->checkIfErrors()) {
            $registry->register();
            echo "Erfolgreich registriert!";
        }else{
            $tpl->assign("Errors", $registry->getErrors());
            $tpl->addMainTemplate("errors.tpl.php");
            if($_POST["gender"] == 1){
                $tpl->assign("checkedOne", $registry->getCheckedGender($_POST["gender"]));
            }elseif($_POST["gender"] == 0){
                $tpl->assign("checkedZero", $registry->getCheckedGender($_POST["gender"]));
            }
        }
    }
    $tpl->addMainTemplate("registry.tpl.php");
    $tpl->addCss(array("name" => "registry.css"));
    $tpl->assign("Title", "Registrierung");
}elseif (isset($_GET["mode"]) && $_GET["mode"] == "school") {
    
}
?>