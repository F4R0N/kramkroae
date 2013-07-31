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
                Date > NOW()
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
                DATE_FORMAT( Updated, '%d.%m.%Y um %H:%i:%s Uhr') as Updated
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
    
    public function insertSubstitution($lesson, $teacher, $substitute, $subjectID, $typeID, $comments, $date){
        if(!$this->isSubject($subjectID)) $this->errors = "Falsches Fach!";
        if(!$this->isDate($date)) $this->errors = "Falsches Datum!";
        
        if(count($this->errors) !== 0)
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
                   NOW(),
                   '" . $this->mysqli->real_escape_string($this->user->getID()) . "'
               );
        ";
        echo $sql;
        $this->mysqli->query($sql);
        return true;
    }

}

// Jedes Date hat Array mit Substitutions-Objecten
?>
