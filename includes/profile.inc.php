<?php
    $tpl->addMainTemplate("profile.tpl.php");
    
    $tpl->addCss(array("name" => "profile.css"));

    $tpl->assign("Title", "Klassenprofil");
    
    $schoolID = $user->getSchoolID();
    $schoolName = $user->getSchoolNameByID($schoolID);
    $tpl->assign("schoolName", $schoolName);

    $classID = $user->getClassID();
    $className = $user->getClassNameByID($classID);
    $tpl->assign("className", $className);
    
    $countClassmates = $user->getCountClassmates();
    $tpl->assign("countCM", $countClassmates);
?>
