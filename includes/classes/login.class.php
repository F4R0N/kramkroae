<?php

class login{
    private $ID;
    
    function login($email, $password) {
        $loginSucceeded = 0;
        $password = explode("$", crypt($password, PASSWORD_SALT));
        $password = $password[4];

        $ID = $this->getIDFromEmail($email);
        if ($ID === false) {
            return false;
        }
        $this->ID = $this->mysqli->real_escape_string($ID);

        if ($this->checkFailedLogins(3, 3)) {
            return $loginSucceeded;
        }

        $result = $this->mysqli->query("
            SELECT
		ID
            FROM
		Users
            WHERE
		ID = '" . $this->ID . "'
                AND
                Password = '" . $this->mysqli->real_escape_string($password) . "'
        ");
        
        if ($result->num_rows === 1) {
            $_SESSION['UserID'] = $this->ID;
            $loginSucceeded = true;
        }
        $this->logLogin($loginSucceeded);
        return $loginSucceeded;
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
}
?>
