<?php

class user {

    private $mysqli;
    private $ID;
    private $Pats;
    private $FirstName;
    private $LastName;

    function __construct($ID) {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        if ($ID !== 0) {
            $this->ID = $this->mysqli->real_escape_string($ID);
            $result = $this->mysqli->query("SELECT FirstName, LastName, Pats from Users WHERE ID = " . $this->ID . "");
            $obj = $result->fetch_object();

            $this->FirstName = $obj->FirstName;
            $this->LastName = $obj->LastName;
            $this->Pats = $obj->Pats;
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    function login($email, $password) {
        $loginSuccessed = 0;

        $ID = $this->getIDFromEmail($email);
        if ($ID === false) {
            return false;
        }
        $this->ID = $this->mysqli->real_escape_string($ID);
        
        if($this->CheckFailedLogins(3, 3)){
            return $loginSuccessed;
        }
        
        $result = $this->mysqli->query("
            SELECT
		ID
            FROM
		Users
            WHERE
		ID = '" . $this->ID . "'
                AND
                Password = '" . $this->mysqli->real_escape_string(md5($password)) . "'
        ");
        if ($result->num_rows === 1) {
            $_SESSION['UserID'] = $this->ID;
            $loginSuccessed = true;
        }
        $this->logLogin($loginSuccessed);
        return $loginSuccessed;
    }

    private function logLogin($loginSuccessed) {
        echo $loginSuccessed;
        $this->mysqli->query("
            INSERT INTO
                Logins (
                    UserID,
                    IP,
                    Succeeded
                )
                VALUES(
                    '" . $this->ID . "',
                    INET_ATON('" . $this->mysqli->real_escape_string($_SERVER["REMOTE_ADDR"]) . "'),
                    '" . $this->mysqli->real_escape_string($loginSuccessed) . "'
                );
        ");
    }

    private function getIDFromEmail($email) {
        $result = $this->mysqli->query("
            SELECT
		ID
            FROM
		Users
            WHERE
		Email = '" . $this->mysqli->real_escape_string($email) . "';
        ");

        if ($result->num_rows !== 1) {
            return false;
        }

        $obj = $result->fetch_object();
        return $obj->ID;
    }

    function logout() {
        session_destroy();
    }

    function updateLastAction() {
        $this->mysqli->query("
            UPDATE
                Users
            SET
                LastAction = NOW()
            WHERE
                ID = " . $this->ID . "
        ");
    }

    function getLoggedLogins() {
        /**
         *@return array with objects of logged logins( IP, Time, Successed )
         * 
         * 
         *  
         **/
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
        
        while($obj = $result->fetch_object()){
            $array[] = $obj;
        }
        return $array;
    }
    
    private function CheckFailedLogins($count, $time){
        $result = $this->mysqli->query("
            SELECT
                UserID
            FROM
                Logins
            WHERE
                Time + INTERVAL " . $this->mysqli->real_escape_string($time) . " MINUTE > NOW()
            AND
                Successed = 0
            AND
                UserID = '" . $this->ID . "'
        ");
        
        if( $result->num_rows >= $count ){
            return true;
        }
        return false;
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

    function getUnreadMessages() {
        $result = $this->mysqli->query(
            "SELECT
                ID
             FROM
                Conversations
             WHERE
                Members LIKE '%;$this->ID;%'
        ");
        $count = $result->num_rows;

        return $count; 
    }
}

?>
