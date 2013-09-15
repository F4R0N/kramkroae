<?php

class schedule {
    private $mysqli;
    private $user;
    private $schedule;
    private $times;

    public function __construct($user) {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        $this->user = $user;
    }
    
    public function __destruct() {
        $this->mysqli->close();
    }
    
    public function getMaxDay(){
        $sql = "SELECT 
                    MAX(Day) 
                AS 
                    Day
                FROM 
                    Schedules 
                WHERE
                    ClassID = '" . $this->user->getClassID() . "'
                ";
        $result = $this->mysqli->query($sql);
        $maxLesson = $result->fetch_object();
        return $maxLesson->Day;
    }
    
    public function checkScheduleAvail(){
        $sql = "SELECT 
                    ID 
                FROM 
                    Schedules 
                WHERE
                    ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
                ";
        $result = $this->mysqli->query($sql);
        if($result->num_rows >= 1){
            return true;
        }else{
            return false;
        }
    }
    
    public function getMaxLesson(){
        $sql = "SELECT 
                    MAX(Lesson) 
                AS 
                    Lesson 
                FROM 
                    Schedules 
                WHERE 
                    ClassID = '" . $this->user->getClassID() . "'
                ";
        $result = $this->mysqli->query($sql);
        $maxLesson = $result->fetch_object();
        return $maxLesson->Lesson;
    }
    
    public function getLessonsTime(){
        $sql="SELECT
                Lesson,
                Time
              FROM
                SchedulesTimes
              WHERE
               ClassID = '" . $this->user->getClassID() . "'
              ";
        $result = $this->mysqli->query($sql);
        while($obj = $result->fetch_object()){
            $this->times[$obj->Lesson] = $obj;
        }
        return $this->times;
    }
    
    public function getSchedule(){
        $sql = "
            SELECT 
                Subject, 
                Schedules.Lesson as 'Lesson', 
                Day, 
                SchedulesTimes.Time as 'Time' 
            FROM 
                Schedules 
            LEFT JOIN 
                Subjects 
            ON 
                Schedules.SubjectID = Subjects.ID
            LEFT JOIN 
                SchedulesTimes 
            ON 
                Schedules.Lesson = SchedulesTimes.Lesson
            WHERE
                Schedules.ClassID = '" . $this->user->getClassID() . "'
                ";
     
        $result = $this->mysqli->query($sql);
        while($obj = $result->fetch_object()){
            $this->schedule[$obj->Day][$obj->Lesson] = $obj;
        }
        return $this->schedule;
    }
    public function editSchedule($lesson, $time, $subject){
        for($i = 0; $i < count($lesson); $i++){
            ?>
            <pre>
                <? print_r($lesson);?>
                <? print_r($time); ?>
                <? print_r($subject); ?>
            </pre>
            <?
            updateScheduleLessonTime($lesson[$i], $time[$i]);
        }
    }
    
    private function updateScheduleLessonTime($lesson, $time){
        $sql = "
                UPDATE
                    ScheduleTimes
                SET
                    Time = 
                ";
    }
    
    public function intoDatabase(){
            $sql = "INSERT INTO 
                        Schedules(
                           ClassID,
                           Day,
                           Lesson,
                           SubjectID
                        ) 
                    VALUES(
                        '". $this->user->getClassID() . "',
                    )";
            $result = $this->mysqli->query($sql);
            if($result){
                return true;
            }else{
                return false;
            }
    }
    
    function getScheduleThead() {
        $scheduleThead[] = array("Stunde", "Uhrzeit", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
        return $scheduleThead;
    }

}

?>
