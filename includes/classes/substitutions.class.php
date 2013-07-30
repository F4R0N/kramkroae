<?php

class substitutions {

    private $errors;
    private $user;
    private $mysqli;
    private $dates;

    public function __construct($user) {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        $this->user = $user;
    }

    public function getCountOfDays(){
        return count($this->dates);
    }
    
    public function setSubstitutions(){
        $this->getDates();
    }
    
    public function getSubstitutions(){
        return $this->dates;
    }
    
    private function getSubstitutionsByDate($date) {
        $sql = "
            SELECT
                `ID`,
                `ClassID`,
                `SchoolID`,
                `SubjectID`,
                DATE_FORMAT( Date, '%d.%m.%Y') as Date,
                DATE_FORMAT( Date, '%w') as DateDay,
                `Lesson`,
                `Teacher`,
                `Substitute`,
                `Type`,
                `Comments`
            FROM
                Substitutions
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
}

// Jedes Date hat Array mit Substitutions-Objecten
?>
