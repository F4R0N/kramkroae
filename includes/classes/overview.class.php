<?php

class overview {

    private $tmrwDate;
    private $tmrwHomeworks;
    private $tmrwEvents;
    private $tmrwSchedule;

    //date_default_timezone_set('Europe/Berlin');

    public function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    public function __destruct() {
        $this->mysqli->close();
    }

    public function getTmrw() {
        $this->tmrwDate = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
        return $this->tmrwDate;
    }

    public function getSubjectByID($subID) {
        $sql = "SELECT Subject FROM Subjects WHERE ID = '" . $subID . "'";
        $result = $this->mysqli->query($sql);
        return $result->fetch_object()->Subject;
    }

    public function getTmrwHomeworks() {
        $data = array();
        $sql = "SELECT 
                    Homework,
                    SubjectID
                FROM
                    Homeworks
                LEFT JOIN
                    Subjects
                ON 
                    Homeworks.SubjectID = Subjects.ID
                WHERE
                    ClassID = '1'
                AND
                    Display = 1
                AND
                    End >= UNIX_TIMESTAMP(NOW())
                AND
                    End < UNIX_TIMESTAMP(NOW()) + 86400
                 ";
        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
            array_push($data, $obj);
        }
        return $data;
    }

    public function getTmrwEvents() {
        $sql = "SELECT
                        Title,
                        End
                    FROM
                        Events
                    WHERE
                        CURDATE() + 1
                    BETWEEN
                        Start
                    AND
                        End
                    OR
                        Start = CURDATE() + 1
                    OR 
                        End = CURDATE() + 1";
        $result = $this->mysqli->query($sql);
        return $result->fetch_object;
    }

    public function getTmrwSchedule() {
        $days = array("Monday" => "1",
            "Tuesday" => "2",
            "Wednesday" => "3",
            "Thursday" => "4",
            "Friday" => "5",
            "Saturday" => "6",
            "Sunday" => "7");
        $sql = "SELECT
                    Lesson,
                    Subject
                FROM
                    Schedules
                LEFT JOIN
                    Subjects
                ON
                    Schedules.SubjectID = Subjects.ID
                WHERE
                    ClassID = '" . $user->getClassID() . "'
                AND
                    Day = '" . $days[date("l", $this->getTmrw())] . "';
                ";
    }

}

?>
