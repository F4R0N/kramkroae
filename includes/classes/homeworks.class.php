<?php

class homeworks {

    private $mysqli;
    private $homeworks;

    public function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    public function setHomeworks() {
        echo $user;
        $sql = "SELECT ID, ClassID, SubjectID, Homework, From, To FROM Homeworks";
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
    
    
}

?>
