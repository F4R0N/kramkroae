<?php

class user {

    private $mysqli;
    private $ID;
    private $Pats;
    private $FirstName;
    private $LastName;
    private $ClassID;
    private $SchoolID;

    function __construct($ID) {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        if ($ID !== 0) {
            $this->ID = $this->mysqli->real_escape_string($ID);
            $result = $this->mysqli->query("SELECT FirstName, LastName, Pats, SchoolID, ClassID from Users WHERE ID = " . $this->ID . "");
            $obj = $result->fetch_object();

            $this->FirstName = $obj->FirstName;
            $this->LastName = $obj->LastName;
            $this->Pats = $obj->Pats;
            $this->SchoolID = $obj->SchoolID;
            $this->ClassID = $obj->ClassID;
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    function logout() {
        session_destroy();
        header("LOCATION: /index.php?screen=login");
    }

    function getLoggedLogins() {
        /**
         * @return array with objects of logged logins( IP, Time, Successed )
         * 
         * 
         *  
         * */
        $result = $this->mysqli->query("
            SELECT
                INET_NTOA( `IP` ) AS  IP,
                DATE_FORMAT( `Time`, 'Am %d. %m. %Y um %H:%m Uhr' ) AS Time,
                Successed
            FROM
                Logins
            WHERE
                UserID = '" . $this->ID . "'
        ");

        while ($obj = $result->fetch_object()) {
            $array[] = $obj;
        }
        return $array;
    }

    function getPats() {
        return $this->Pats;
    }

    function getLastName() {
        return $this->LastName;
    }

    function getFirstName() {
        return $this->FirstName;
    }

    function getID() {
        return $this->ID;
    }

    function getSchoolID() {
        return $this->SchoolID;
    }

    function getClassID() {
        return $this->ClassID;
    }

    function getClassmates() {
        $sql = "SELECT
                    FirstName,
                    LastName
                FROM
                    Users
                WHERE
                    ClassID = '" . $this->ClassID . "'
                ORDER BY
                    RegistryDate DESC
                ";
        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
            $Classmates[] = $obj;
        }
        return $Classmates;
    }

    function getCountClassmates() {
        return count($this->getClassmates());
    }

    function hasRight($right) {
        $sql = "SELECT 
                    * 
                FROM 
                    RightProperties 
                LEFT JOIN 
                    Rights 
                ON 
                    RightProperties.RightID = Rights.ID
                WHERE 
                    `Right` = '" . $this->mysqli->real_escape_string($right) . "'
                OR
                    `Right` = 'God'
                AND 
                    UserID = " . $this->ID . "
                ";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows !== 0) {
            return true;
        }else{
            return false;
        }
    }
    
    function getClassesFromSchool(){
        $sql = "SELECT 
                    ClassName 
                FROM 
                    Classes 
                WHERE
                    SchoolID = '" . $this->SchoolID . "'
                ORDER BY 
                    RegistryDate DESC";
        $result = $this->mysqli->query($sql);
        
        while ($obj = $result->fetch_object()) {
            $Classes[] = $obj;
        }
        return $Classes;
    }

}

?>
