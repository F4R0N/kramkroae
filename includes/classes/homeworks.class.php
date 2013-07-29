<?php

class homeworks {

    private $mysqli;
    private $homeworks;
    private $user;
    private $subjects;

    public function __construct($user) {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        $this->user = $user;
    }

    public function setHomeworks() {
        $sql = "
            SELECT 
                Homeworks.ID,
                Homework,
                DATE_FORMAT( Start, '%d.%m.%Y') as Start,
                DATE_FORMAT(Start, '%w') as StartDay,
                DATE_FORMAT( `End`, '%d.%m.%Y' ) as End,
                DATE_FORMAT(End, '%w') as EndDay,
                Subject
            FROM 
                Homeworks 
            LEFT JOIN 
                Subjects 
            ON
                Homeworks.SubjectID = Subjects.ID 
            WHERE
                ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
            AND End > Now()
        ";
        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
            $this->homeworks[] = $obj;
        }
    }

    public function getCountOfHomeworks() {
        return count($this->homeworks);
    }

    public function getHomeworks() {
        return $this->homeworks;
    }

    public function getLastUpdate() {
        $sql = "
            SELECT
                DATE_FORMAT( Updated, '%d.%m.%Y um %H:%i:%s Uhr') as Updated
            FROM
                Homeworks
            WHERE
                ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
            ORDER BY 
                Updated ASC 
            LIMIT 0, 1
        ";
        $result = $this->mysqli->query($sql);
        $obj = $result->fetch_object();
        return $obj->Updated;
    }

    public function getLastUpdaterID() {
        $sql = "
        SELECT
            UpdatedBy 
        FROM 
            Homeworks
        WHERE
            ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
        ORDER BY 
            Updated ASC 
        LIMIT 0, 1
        
        ";

        $result = $this->mysqli->query($sql);
        $obj = $result->fetch_object();
        return $obj->UpdatedBy;
    }

    public function insertHomework($homework, $start, $end, $subjectID) {
        if ($this->isDate($start) && $this->isDate($end)) {
            $sql = "
            INSERT INTO
                Homeworks(
                    Homework,
                    Start,
                    End,
                    SubjectID,
                    ClassID,
                    UpdatedBy
                )
                VALUES(
                    '" . $this->mysqli->real_escape_string($homework) . "',
                    '" . $this->mysqli->real_escape_string($start) . "',
                    '" . $this->mysqli->real_escape_string($end) . "',
                    '" . $this->mysqli->real_escape_string($subjectID) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getID()) . "'
                );
        ";    
          $this->mysqli->query($sql);

            return true;
        } else {
            return "Falsches Datum!";
        }
    }

    private function isDate($date) {
        $tmpDate = date_parse($date);
        if (checkdate($tmpDate["month"], $tmpDate["day"], $tmpDate["year"])) {
            return true;
        }
    }

    public function setSubjects() {
        $sql = "
            SELECT
                *
            FROM
                Subjects
        ";
        $result = $this->mysqli->query($sql);

        while ($obj = $result->fetch_object()) {
            $this->subjects[] = $obj;
        }
    }

    public function getSubjects() {
        return $this->subjects;
    }

}

?>
