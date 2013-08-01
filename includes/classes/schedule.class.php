<?php

class schedule {
    private $mysqli;
    private $user;
    private $schedule;

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
        if($result->num_rows == 1){
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
    
    public function getSchedule(){
        $sql = "SELECT 
                    Subject,
                    Lesson,
                    Day
                FROM 
                    Schedules 
                LEFT JOIN 
                    Subjects 
                ON 
                    Schedules.SubjectID = Subjects.ID 
                WHERE ClassID = '" . $this->user->getClassID() . "'
                ";
        $result = $this->mysqli->query($sql);
        while($obj = $result->fetch_object()){
            $this->schedule[$obj->Day][$obj->Lesson] = $obj;
        }
        return $this->schedule;
    }
            
    function getScheduleTbody() {
        $schedule = array(
            array('1.', '7:45 - 8:30', 'Sport', 'Englisch', 'Englisch', 'Sport', 'Englisch', 'Englisch', 'Englisch'),
            array('2.', '8:35 - 9:20', 'Sport', 'Sport', 'Sport', 'Sport', 'Sport', 'Sport', 'Sport'),
            array('3.', '9:35 - 10:20', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde'),
            array('4.', '10:25 - 11:10', 'Informatik', 'Informatik', 'Informatik', 'Informatik', 'Informatik', 'Informatik', 'Informatik'),
            array('5.', '11:25 - 12:10', 'Biologie', 'Biologie', 'Biologie', 'Biologie', 'Biologie', 'Biologie', 'Biologie'),
            array('6.', '12:15 - 13:00', 'Musik', 'Musik', 'Musik', 'Musik', 'Musik', 'Musik', 'Musik'),
            array('7.', '13:20 - 14:05', 'Mathe', 'Mathe', 'Mathe', 'Mathe', 'Mathe', 'Mathe', 'Mathe'),
            array('8.', '14:10 - 14:55', 'Physik', 'Physik', 'Physik', 'Physik', 'Physik', 'Physik', 'Physik'),
            array('9.', '15:00 - 15:45', 'Chemie', 'Chemie', 'Chemie', 'Chemie', 'Chemie', 'Chemie', 'Chemie')
        );
        return $schedule;
    }

    function getScheduleThead() {
        $scheduleThead[] = array("Stunde", "Uhrzeit", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
        return $scheduleThead;
    }

}

?>
