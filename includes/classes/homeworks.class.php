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

    private function unixToFormatDate($unixTS) {
        return date("d.m.Y H:i", $unixTS);
    }

    private function timestampToUnixTS($timestamp) {
        $tsArray = explode("-", $timestamp);
        $year = $tsArray[0];
        $month = $tsArray[1];
        $day = $tsArray[2];
        return mktime(0, 0, 0, $month, $day, $year);
    }

    public function setHomeworks() {
        $sql = "
            SELECT 
                Homeworks.ID,
                Homework,
                Start,
                End,
                Subject
            FROM 
                Homeworks 
            LEFT JOIN 
                Subjects 
            ON
                Homeworks.SubjectID = Subjects.ID 
            WHERE
                ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
            AND 
                End > UNIX_TIMESTAMP(NOW())
            AND
                Display = 1
            ORDER BY
                END ASC
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
                Updated
            FROM
                Homeworks
            WHERE
                ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
            ORDER BY
            	Updated DESC
            LIMIT
            	0,1
        ";
        $result = $this->mysqli->query($sql);
        $obj = $result->fetch_object();
        return $this->unixToFormatDate($obj->Updated+7200);
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
                    Updated,
                    Display
                )
                VALUES(
                    '" . trim($this->mysqli->real_escape_string($homework)) . "',
                    '" . $this->timestampToUnixTS($this->mysqli->real_escape_string($start)) . "',
                    '" . $this->timestampToUnixTS($this->mysqli->real_escape_string($end)) . "',
                    '" . $this->mysqli->real_escape_string($subjectID) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getID()) . "',
                    UNIX_TIMESTAMP(NOW()),
                    1
                );
        ";
        $this->mysqli->query($sql);

        return true;
    }

    public function deleteHomework($id) {
        $sql = '
            Update
                Homeworks
            SET
                Display = 0
            WHERE
                ID = ?
        ';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $this->mysqli->real_escape_string($id));
        $stmt->execute();
        $stmt->close();

        return true;
    }
    
    public function deleteHomeworkByDate(){
        $sql = 'UPDATE Homeworks SET Display = 0 WHERE End < UNIX_TIMESTAMP(NOW()) LIMIT 50';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        $stmt->close();
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

        $sql = '
            UPDATE
                Homeworks
            SET
                Homework = ?,
                SubjectID = ?,
                Start = ?,
                End = ?,
                UpdatedBy = ?,
                Updated = UNIX_TIMESTAMP(NOW())
            WHERE
                ID = ?
        ';
        
        $stmt = $this->mysqli->prepare($sql);
        $stmt->prepare($sql);
        $stmt->bind_param('siiiii', trim($this->mysqli->real_escape_string($homework)), 
                                    $this->mysqli->real_escape_string($subjectID),
                                    $this->timestampToUnixTS($this->mysqli->real_escape_string($start)),
                                    $this->timestampToUnixTS($this->mysqli->real_escape_string($end)),
                                    $this->mysqli->real_escape_string($this->user->getID()),
                                    $this->mysqli->real_escape_string($id));
        $stmt->execute();
        $stmt->close();
        
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
