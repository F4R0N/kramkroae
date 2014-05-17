<?php

class substitutions {

    private $errors;
    private $user;
    private $mysqli;
    private $dates;
    private $types;

    public function __construct($user) {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        $this->user = $user;
    }

    function checkUml($word) {
        if (preg_match("/ä/", $word)) {
            $suchmuster = '/ä/';
            $ersetzungen = 'ae';
            return preg_replace($suchmuster, $ersetzungen, $word);
        } else if (preg_match("/ö/", $word)) {
            $suchmuster = '/ö/';
            $ersetzungen = 'oe';
            return preg_replace($suchmuster, $ersetzungen, $word);
        } else if (preg_match("/ü/", $word)) {
            $suchmuster = '/ü/';
            $ersetzungen = 'ue';
            return preg_replace($suchmuster, $ersetzungen, $word);
        } else {
            return $word;
        }
    }

    public function getCountOfDays() {
        return count($this->dates);
    }

    public function setSubstitutions() {
        $this->getDates();
    }

    public function getSubstitutions() {
        return $this->dates;
    }

    private function getSubstitutionsByDate($date) {
        $sql = "
            SELECT
                Substitutions.ID,
                `ClassID`,
                `SchoolID`,
                `SubjectID`,
                DATE_FORMAT( Date, '%d.%m.%Y') as Date,
                DATE_FORMAT( Date, '%w') as DateDay,
                `Lesson`,
                `Teacher`,
                `Substitute`,
                `Type`,
                `Comments`,
                `Subject`,
                `Type`
            FROM
                Substitutions
            LEFT JOIN 
                Subjects 
            ON
                Substitutions.SubjectID = Subjects.ID
            LEFT JOIN 
                SubstitutionTypes 
            ON
                Substitutions.TypeID = SubstitutionTypes.ID
            WHERE
                Date = '" . $this->mysqli->real_escape_string($date) . "'
            AND
                ClassID = '" . $this->user->getClassID() . "'
            ORDER BY
                Lesson ASC
        ";
        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
            $this->dates[$date][] = $obj;
        }
    }

    private function getDates() {
        $sql = "
            SELECT
                Date
            FROM
                Substitutions
            WHERE 
                `ClassID` = 1
            AND
                Date > NOW() - INTERVAL 1 DAY
            GROUP BY
                Date
            ORDER BY
                Date ASC
        ";
        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
            $this->getSubstitutionsByDate($obj->Date);
        }
    }

    public function getLastUpdate() {
        $sql = "
            SELECT
                Updated
            FROM
                Substitutions
            WHERE
                ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "'
            ORDER BY 
                Updated DESC
            LIMIT
            	0,1

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
            Substitutions
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

    private function isDate($date) {
        $tmpDate = date_parse($date);
        if (checkdate($tmpDate["month"], $tmpDate["day"], $tmpDate["year"])) {
            return true;
        }
    }

    public function setSubstitutionTypes() {
        $sql = "
            SELECT
                *
            FROM
                SubstitutionTypes
         ";

        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
            $this->types[] = $obj;
        }
    }

    public function getSubstitutionTypes() {
        return $this->types;
    }

    public function insertSubstitution($lesson, $teacher, $substitute, $subjectID, $typeID, $comments, $date) {
        $validSubTypes = [1, 2, 3, 4];
        if (!$this->isSubject($subjectID))
            $this->errors[] = "Ung&uuml;ltiges Fach!";
        if (!$this->isDate($date))
            $this->errors[] = "Ung&uuml;ltiges Datum!";
        if (!in_array($typeID, $validSubTypes))
            $this->errors[] = "Ung&uuml;ltige Art!";
        if (!is_numeric($lesson))
            $this->errors[] = "Ung&uuml;ltige Unterrichtsstunde!";
        if (!ctype_alpha($this->checkUml($teacher)))
            $this->errors[] = "Ung&uuml;ltige/r Lehrer/in!";
        if (!ctype_alpha($substitute) && $substitute != "" && $substitute != "/")
            $this->errors[] = "Ung&uuml;ltige Vertretung!";

        if (count($this->errors) !== 0)
            return false;

        $sql = "
            INSERT INTO
                Substitutions(
                    ClassID,
                    SchoolID,
                    SubjectID,
                    Date,
                    Lesson,
                    Teacher,
                    Substitute,
                    TypeID,
                    Comments,
                    Updated,
                    UpdatedBy
                )
                VALUES(
                   '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "',
                   '" . $this->mysqli->real_escape_string($this->user->getSchoolID()) . "',
                   '" . $this->mysqli->real_escape_string($subjectID) . "',
                   '" . $this->mysqli->real_escape_string($date) . "',
                   '" . $this->mysqli->real_escape_string($lesson) . "',
                   '" . $this->mysqli->real_escape_string($teacher) . "',
                   '" . $this->mysqli->real_escape_string($substitute) . "',
                   '" . $this->mysqli->real_escape_string($typeID) . "',
                   '" . $this->mysqli->real_escape_string($comments) . "',
                   UNIX_TIMESTAMP(NOW()),
                   '" . $this->mysqli->real_escape_string($this->user->getID()) . "'
               );
        ";
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            
        }
    }

    public function updateSubstitutions($ID, $lesson, $teacher, $substitute, $subjectID, $typeID, $comments, $date) {
        for ($i = 0; $i < count($ID); $i++) {
            if (!$this->updateSubstitution($ID[$i], $lesson[$i], $teacher[$i], $substitute[$i], $subjectID[$i], $typeID[$i], $comments[$i], $date[$i])) {
                return false;
            }
        }
        return true;
    }

    public function updateSubstitution($ID, $lesson, $teacher, $substitute, $subjectID, $typeID, $comments, $date) {
        if (!$this->isSubject($subjectID))
            $this->errors[] = "Ungültiges Fach!";
        if (!$this->isDate($date))
            $this->errors[] = "Ungültiges Datum!";
        if (!is_numeric($lesson))
            $this->errors[] = "Ung&uuml;ltige Unterrichtsstunde!";
        if (!ctype_alpha($this->checkUml($teacher)))
            $this->errors[] = "Ung&uuml;ltige/r Lehrer/in!";
        if (!ctype_alpha($substitute) && $substitute != "" && $substitute != "/")
            $this->errors[] = "Ung&uuml;ltige Vertretung!";
        if (count($this->errors) !== 0)
            return false;

        $sql = "
            UPDATE
                Substitutions
                    
            SET
                ClassID = '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "',
                SchoolID = '" . $this->mysqli->real_escape_string($this->user->getSchoolID()) . "',
                SubjectID = '" . $this->mysqli->real_escape_string($subjectID) . "',
                Date = '" . $this->mysqli->real_escape_string($date) . "',
                Lesson = '" . $this->mysqli->real_escape_string($lesson) . "',
                Teacher = '" . $this->mysqli->real_escape_string($teacher) . "',
                Substitute = '" . $this->mysqli->real_escape_string($substitute) . "',
                TypeID = '" . $this->mysqli->real_escape_string($typeID) . "',
                Comments = '" . $this->mysqli->real_escape_string($comments) . "',
                Updated = UNIX_TIMESTAMP(NOW()),
                UpdatedBy = '" . $this->mysqli->real_escape_string($this->user->getID()) . "'
            WHERE
                ID = '" . $this->mysqli->real_escape_string($ID) . "'
        ";
        $this->mysqli->query($sql);
        return true;
    }

    public function deleteSubstitution($id) {
        $sql = "
            DELETE FROM
                Substitutions
            WHERE
                ID = '" . $this->mysqli->real_escape_string($id) . "'
        ";

        $this->mysqli->query($sql);
        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

}

// Jedes Date hat Array mit Substitutions-Objecten
?>
