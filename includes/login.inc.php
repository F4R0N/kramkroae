<?php
    include_once "classes/login.class.php";
    
    $login = new login();
    
    $tpl->assign("Title", "Startseite");
    $tpl->addMainTemplate("login.tpl.php");
    $tpl->addCss(array("name" => "login.css"));
    
    if (filter_var($_COOKIE["Email"], FILTER_VALIDATE_EMAIL)){
        $email = $_COOKIE["Email"];
        $checked = "checked";
   }
    else {
       $email = "";
       $checked = "";
    }
    
    $tpl->assign("Email", $email);
    $tpl->assign("Checked", $checked);
    
    if(isset($_POST["loginEmail"]) && isset($_POST["loginPass"])){
        $email = $_POST["loginEmail"];
        $password = $_POST["loginPass"];
        $saveMail = $_POST["rememberEmail"];
        $login->login($email, $password, $saveMail);
        header("Location: /index.php?screen=overview");
    }
?>
