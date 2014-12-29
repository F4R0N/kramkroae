<?php
    include_once "classes/schedule.class.php";
    
    $schedule = new schedule($user);
    
    $tpl->assign("Title", "Stundenplan");
    $tpl->addMainTemplate("schedule.tpl.php");
    
    $tpl->addCss(array("name" => "style.css"));
    $tpl->addCss(array("name" => "schedule.css"));
    
    $tpl->assign("LessonTimes", $schedule->getTimes($user->getSchoolID()));
    $lessons = $schedule->getSubjects($user->getClassID());
   
    //print_r($lessons);
    $monday = array();
    $tuesday = array();
    $wednesday = array();
    $thursday = array();
    $friday = array();
    for($i = 0; $i <= 10; $i++){
        $monday[$i] = $lessons[$i];
    }
    for($i = 11; $i <= 21; $i++){
        $tuesday[$i] = $lessons[$i];
    }
    for($i = 22; $i <= 31; $i++){
        $wednesday[$i] = $lessons[$i];
    }
    for($i = 33; $i <= 41; $i++){
        $thursday[$i] = $lessons[$i];
    }
    for($i = 44; $i <= 51; $i++){
        $friday[$i] = $lessons[$i];
    }
    $tpl->assign("LessonsMonday", $monday);
    $tpl->assign("LessonsTuesday", $tuesday);
    $tpl->assign("LessonsWednesday", $wednesday);
    $tpl->assign("LessonsThursday", $thursday);
    $tpl->assign("LessonsFriday", $friday);
    print_r($tuesday);
?>
