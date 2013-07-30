<?php
    $tpl->assign("Title", "Fabian1998.de - Startseite");
    $tpl->addMainTemplate("login.tpl.php");
    $tpl->addCss(array("name" => "login.css"));
    
    if(isset($_POST["loginEmail"]) && isset($_POST["loginPass"])){
        
    }
?>
