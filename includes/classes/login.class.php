<?php

class login {

    private $ID;

    function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    function __destruct() {
        $this->mysqli->close();
    }

    private function setEmailCookie($saveMail, $email) {
        if ($saveMail) {
            setcookie("Email", $email, time() + 60 * 60 * 24 * 30);
        } else {
            setcookie("Email", "", time() - 1337);
        }
    }

    function login($email, $password, $saveMail) {
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
            $this->setEmailCookie($saveMail, $email);
            $loginSucceeded = true;
            $sql = "UPDATE Users SET SecurityCode = '0'";
            $result = $this->mysqli->query($sql);
        }
        $this->logLogin($loginSucceeded);
        return $loginSucceeded;
    }

    private function logLogin($loginSucceeded) {
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
                    '" . $this->mysqli->real_escape_string($loginSucceeded) . "'
                );
        ");
    }

    private function checkFailedLogins($count, $time) {
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

        if ($result->num_rows >= $count) {
            return true;
        }
        return false;
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
