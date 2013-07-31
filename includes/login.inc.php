<?php
    include_once "classes/login.class.php";
    
    $login = new login();
    
    $tpl->assign("Title", "Fabian1998.de - Startseite");
    $tpl->addMainTemplate("login.tpl.php");
    $tpl->addCss(array("name" => "login.css"));
    
    if(isset($_POST["loginEmail"]) && isset($_POST["loginPass"])){
        $email = $_POST["loginEmail"];
        $password = $_POST["loginPass"];
        $login->login($email, $password);
        header("Location: /index.php?screen=overview");
    }
?>
