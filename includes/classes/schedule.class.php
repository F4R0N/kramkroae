<?php
    class schedule{
        private $mysqli;
        private $user;
        private $LessonTimes = array();
        
        public function __construct($user) {
            $this->user = $user;
            $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        }
        
        public function getTimes($schoolID){
            $sql = "SELECT LessonTime FROM SchedulesTimes WHERE SchoolID=" . $schoolID . " ORDER BY Lesson";
            $result = $this->mysqli->query($sql);
            while ($row = $result->fetch_array()) {
                $this->LessonTimes[] = $row;
            }
            return $this->LessonTimes;
        }
        
        public function getSubjects($classID){
            $sql = "SELECT
                        Subjects.Subject
                    FROM 
                            Schedules 
                    LEFT JOIN
                            Subjects
                    ON
                            Schedules.`SubjectID` = Subjects.ID
                    WHERE
                            ClassID = ". $classID ."
                    ORDER BY 
                            Day";
            $result = $this->mysqli->query($sql);
            while ($row = $result->fetch_array()) {
                $this->Lessons[] = $row;
            }
            return $this->Lessons;
        }
    }
?>