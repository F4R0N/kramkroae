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

    public function getMaxDay() {
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

    public function checkScheduleAvail() {
        $sql = "SELECT 
                    ID 
                FROM 
                    Schedules 
                WHERE
                    ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
                ";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getMaxLesson() {
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

    public function getLessonsTime() {
        $sql = "SELECT
                    Lesson,
                    LessonTime
                FROM
                    SchedulesTimes
                WHERE
                    ClassID = '" . $this->user->getClassID() . "'
                ";
        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
<<<<<<< HEAD
            $this->times[$obj->LessonTime] = $obj;
        }
        return $this->times;
    }

=======
            $this->times[$obj->Lesson] = $obj;
        }
        return $this->times;
    }
    
>>>>>>> schedule
    public function getSchedule() {
        $sql = "
            SELECT 
                Subject, 
                Schedules.Lesson as 'Lesson', 
                Day, 
                SchedulesTimes.LessonTime as 'LessonTime' 
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
        while ($obj = $result->fetch_object()) {
            $this->schedule[$obj->Day][$obj->Lesson] = $obj;
        }
        return $this->schedule;
    }

    public function editSchedule($lesson, $time, $subject) {
<<<<<<< HEAD

        for ($i = 0; $i < count($lesson); $i++) {
            if($this->checkWhetherTimeUpdateOrInsert($_POST["time"]) == 0){
                $this->updateScheduleLessonTime($lesson[$i], $time[$i]);
            }else if($this->checkWhetherTimeUpdateOrInsert($_POST["time"]) == 1){
                // Loeschen
            }else if($this->checkWhetherTimeUpdateOrInsert($_POST["time"]) == 2){
                // EInfuegen
            }
=======
        $sql = "DELETE FROM SchedulesTimes WHERE ClassID = '" . $this->user->getClassID();
        $result = $this->mysqli->query($sql);
        
        for($i = 0; $i <= 10; $i++){
            $sql = "INSERT INTO 
                        SchedulesTimes(
                            ClassID, 
                            Lesson, 
                            LessonTime) 
                    VALUES(
                        '" . $this->user->getClassID() . "',
                        '" . $lesson[$i] . "',
                        '" . $time[$i] . "'
                            )";
            $this->mysqli->query($sql);
>>>>>>> schedule
        }
    }

    private function checkWhetherTimeUpdateOrInsert($postTime) {
        // aktuelle Time
        $times = array();
        for ($i = 1; $i <= 11; $i++) {
<<<<<<< HEAD
            $time = $VARS["scheduleBody"][1][$i]->Time;
            if ($time) {
                array_push($times, $time);
            }
            $firstCount = count($times);
        }
=======
            if ($VARS["scheduleBody"][1][$i]->Time) {
                array_push($times, $time);
            }
        }
        print_r($times);
        $firstCount = count($times);
>>>>>>> schedule
            
        // geänderte Time
        $secTimes = array();
        $secTime = $postTime;
        for ($i = 0; $i <= 10; $i++) {
            if ($secTime[$i]) {
                array_push($secTimes, $secTime[$i]);
            }
        }
        $secCount = count($secTimes);
<<<<<<< HEAD
        if ($count == $secCount) {
            //echo "Updaten";
            return 0;
        } else if ($count > $secCount) {
            //echo "Delete";
            return 1;
        } else if ($count < $secCount) {
            //echo "Insert";
            return 2;
        }
=======
        if ($firstCount == $secCount) {
            //echo "Updaten";
            return 0;
        } else if ($firstCount > $secCount) {
            //echo "Delete";
            return 1;
        } else if ($firstCount < $secCount) {
            //echo "Insert";
            return 2;
        }
        echo $secCount;
>>>>>>> schedule
    }

    private function updateScheduleLessonTime($lesson, $time) {
        $sql = "
                UPDATE
                    SchedulesTimes
                SET
                    LessonTime = '" . $time . "'
                WHERE
                    Lesson = " . $lesson . "
                AND
                   ClassID = " . $this->user->getClassID() . "
                ";

        $this->mysqli->query($sql);
    }

    private function updateScheduleSubjects($subID, $lesson, $day) {
        $sql = "
                UPDATE
                    Schedules
                LEFT JOIN
                    Subjects
                ON 
                    Subjects.Subject = '" . $subID . "'
                SET
                    Schedules.SubjectID = 
                WHERE
                    Lesson = " . $lesson . "
                AND
                   ClassID = " . $this->user->getClassID() . "
                ";
        die("<pre>$sql</pre>");
        $this->mysqli->query($sql);
    }

    public function intoDatabase() {
        $sql = "INSERT INTO 
                        Schedules(
                           ClassID,
                           Day,
                           Lesson,
                           SubjectID
                        ) 
                    VALUES(
                        '" . $this->user->getClassID() . "',
                    )";
        $result = $this->mysqli->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function getScheduleThead() {
        $scheduleThead[] = array("Stunde", "Uhrzeit", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag");
        return $scheduleThead;
    }

}

?>
