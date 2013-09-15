<?php

class homeworks {

    private $mysqli;
    private $homeworks;
    private $user;
    private $subjects;
    private $errors;

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
                Updated DESC 
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
            Updated DESC 
        LIMIT 0, 1
        
        ";

        $result = $this->mysqli->query($sql);
        $obj = $result->fetch_object();
        return $obj->UpdatedBy;
    }

    public function insertHomework($homework, $start, $end, $subjectID) {
        $this->errors = array();

        if (!$this->isDate($start) || !$this->isDate($end))
            $this->errors[] = "Ungültiges Datum!";
        if (!$this->isSubject($subjectID))
            $this->errors[] = "Ungültiges Fach!";
        if (strlen($homework) <= 1)
            $this->errors[] = "Hausaufgaben dürfen nicht leer sein!";

        if (count($this->errors) !== 0)
            return false;

        $sql = "
            INSERT INTO
                Homeworks(
                    Homework,
                    Start,
                    End,
                    SubjectID,
                    ClassID,
                    UpdatedBy,
                    Updated
                )
                VALUES(
                    '" . trim($this->mysqli->real_escape_string($homework)) . "',
                    '" . $this->mysqli->real_escape_string($start) . "',
                    '" . $this->mysqli->real_escape_string($end) . "',
                    '" . $this->mysqli->real_escape_string($subjectID) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getID()) . "',
                    NOW()
                );
        ";
        $this->mysqli->query($sql);

        return true;
    }

    public function deleteHomework($id) {
        $sql = "
            DELETE
            FROM
                Homeworks
            WHERE
                ID = '" . $this->mysqli->real_escape_string($id) . "'
        ";

        $this->mysqli->query($sql);

        return true;
    }

    public function editHomeworks($id, $homework, $start, $end, $subjectID) {
        for ($i = 0; $i < count($id); $i++) {
            if (!$this->editHomework($id[$i], $homework[$i], $start[$i], $end[$i], $subjectID[$i]))
                return false;
        }
        return true;
    }

    private function editHomework($id, $homework, $start, $end, $subjectID) {
        $this->errors = array();
        if (!$this->isDate($start) || !$this->isDate($end))
            $this->errors[] = "Ungültiges Datum!";
        if (!$this->isSubject($subjectID))
            $this->errors[] = "Ungültiges Fach!";
        if (strlen($homework) <= 1)
            $this->errors[] = "Hausaufgaben dürfen nicht leer sein!";

        if (count($this->errors) !== 0)
            return false;

        $sql = "
            UPDATE
                Homeworks
            SET
                Homework = '" . trim($this->mysqli->real_escape_string($homework)) . "',
                SubjectID = '" . $this->mysqli->real_escape_string($subjectID) . "',
                Start = '" . $this->mysqli->real_escape_string($start) . "',
                End = '" . $this->mysqli->real_escape_string($end) . "',
                UpdatedBy = '" . $this->mysqli->real_escape_string($this->user->getID()) . "',
                Updated = NOW()
            WHERE
                ID = '" . $this->mysqli->real_escape_string($id) . "'
        ";
        $this->mysqli->query($sql);
        return true;
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

    private function isSubject($subjectID) {
        $sql = "
            SELECT
                *
            FROM
                Subjects
            WHERE
                ID = '" . $this->mysqli->real_escape_string($subjectID) . "'
        ";
        $result = $this->mysqli->query($sql);

        return $result->num_rows;
    }

    public function getErrors() {
        return $this->errors;
    }

}

?>
