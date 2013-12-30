<?php
    require_once 'classes/school.class.php';
    
    $school = new school($user);

    $tpl->addMainTemplate("profile.tpl.php");
    
    $tpl->addCss(array("name" => "profile.css"));

    $tpl->assign("Title", "Klassenprofil");
    
    $schoolID = $user->getSchoolID();
    $schoolName = $school->getSchoolNameByID($schoolID);
    $tpl->assign("schoolName", $schoolName);

    $classID = $user->getClassID();
    $className = $school->getClassNameByID($classID);
    $tpl->assign("className", $className);
    
    $countClassmates = $user->getCountClassmates();
    $tpl->assign("countCM", $countClassmates);
    
    $classRDate = $school->getClassRegistryDateByID($classID, 2);
    $tpl->assign("classRDate", $classRDate);
    
    $HWUploaded = $school->getHWUploadedByClassID($classID);
    $tpl->assign("HWUploaded", $HWUploaded);
    
    $subsUploaded = $school->countSubsByClassID($classID);
    $tpl->assign("subsUploaded", $subsUploaded);
    
    $countCourses = $school->countClassCoursesByClassID($classID);
    $tpl->assign("$countCourses", $countCourses);
    
?>
