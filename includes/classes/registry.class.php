<?php

class registry {

    private $mysqli;
    private $firstName;
    private $lastName;
    private $email;
    private $emailCheck;
    private $password;
    private $passwordCheck;
    private $gender;
    private $schoolID;
    private $acceptTerms;
    private $errors = array();

    function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    function __destruct() {
        $this->mysqli->close();
    }

    function getCheckedGender($gender) {
        if ($gender == "0") {
            return 'checked = "checked"';
        } elseif ($gender == "1") {
            return 'checked = "checked"';
        }
    }

    function getErrors() {
        return $this->errors;
    }

    function checkIfErrors() {
        if ($this->getRegistryValues() == true && $this->checkNames() == false &&
                $this->checkPassword() == false && $this->checkEmail() == false &&
                $this->checkGender() == false && $this->checkSchoolID() == false &&
                $this->checkAcceptTerms() == false) {
            return false;
        }else{
            return true;
        }
    }

    function register() {
        $this->intoDatabase();
        $this->sendRegistryEmail();
        return true;
    }

    function getRegistryValues() {
        $this->firstName = $this->mysqli->real_escape_string(trim($_POST["firstName"]));
        $this->lastName = $this->mysqli->real_escape_string(trim($_POST["lastName"]));
        $this->email = strtolower($this->mysqli->real_escape_string(trim($_POST["email"])));
        $this->password = $this->mysqli->real_escape_string(trim($_POST["password"]));
        $this->passwordCheck = $this->mysqli->real_escape_string(trim($_POST["passwordCheck"]));
        $this->gender = $this->mysqli->real_escape_string(trim($_POST["gender"]));
        $this->schoolID = $this->mysqli->real_escape_string(trim($_POST["schoolID"]));
        $this->acceptTerms = $this->mysqli->real_escape_string(trim($_POST["acceptTerms"]));

        return true;
    }

    function checkUml($word){
	if(preg_match("/ä/", $word)){
		$suchmuster = '/ä/';
		$ersetzungen = 'ae';
		return preg_replace($suchmuster, $ersetzungen, $word);
	}else if(preg_match("/ö/", $word)){
		$suchmuster = '/ö/';
		$ersetzungen = 'oe';
		return preg_replace($suchmuster, $ersetzungen, $word);
	}else if(preg_match("/ü/", $word)){
		$suchmuster = '/ü/';
		$ersetzungen = 'ue';
		return preg_replace($suchmuster, $ersetzungen, $word);
	}else{
		return $word;
	}
}
    
    function checkNames() {
        if ($this->firstName == "") {
            return true;
        } elseif (!ctype_alpha($this->checkUml($this->firstName))) { 
            return true;
        } elseif ($this->lastName == "") {
            return true;
        } elseif (!ctype_alpha($this->checkUml($this->lastName))) {
            return true;
        } else {
            return false;
        }
    }

    function checkEmail() {
        $sql = "SELECT 
                    ID 
                FROM 
                    Users 
                WHERE 
                    Email = '" . $this->email . "'
               ";
        $result = $this->mysqli->query($sql);
        $numberUser = $result->num_rows;

        if ($this->email == "") {
            return true;
        } elseif ($numberUser !== 0) {
            return true;
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    function checkPassword() {
        if ($this->password !== $this->passwordCheck) {
            return true;
        } elseif (strlen($this->password) < 6) {
            return true;
        } elseif (ctype_alpha($this->password)) {
            return true;
        } elseif (ctype_digit($this->password)) {
            return true;
        } else {
            return false;
        }
    }

    function checkGender() {
        if ($this->gender < 0 || $this->gender > 1) {
            return true;
        } else {
            return false;
        }
    }

    function checkSchoolID() {
        $sql = "SELECT SchoolName FROM Schools WHERE ID = " . $this->schoolID;
        $result = $this->mysqli->query($sql);
        $number = $result->num_rows;
        if ($number != 1) {
            return true;
        } else {
            return false;
        }
    }

    function checkAcceptTerms() {
        if ($this->acceptTerms != "1") {
            return true;
        } else {
            return false;
        }
    }

    function intoDatabase() {
        $password = explode("$", crypt($this->password, PASSWORD_SALT));
        $password = $password[4];
        $sql = "INSERT INTO
                    Users (FirstName, LastName, Email, Password, Gender, Pats, SchoolID, ClassID, AcceptTerms, RegistryDate)
                VALUES
                    ('" . $this->mysqli->real_escape_string(ucfirst($this->firstName)) . "',
                    '" . $this->mysqli->real_escape_string(ucfirst($this->lastName)) . "',
                    '" . $this->mysqli->real_escape_string($this->email) . "',
                    '" . $this->mysqli->real_escape_string($password) . "',
                    '" . $this->mysqli->real_escape_string($this->gender) . "',
                    '0',
                    '" . $this->mysqli->real_escape_string($this->schoolID) . "',
                    '1',
                    '" . $this->mysqli->real_escape_string($this->acceptTerms) . "',
                    CURDATE()
                    )
                ";
        if ($result = $this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function sendRegistryEmail() {
        $receiver = $this->email;
        $subject = "Willkommen bei Fabian1998";
        $message = "<html>
<body>
<h3>Willkommen bei Fabian1998 " . $this->firstName . " " . $this->lastName . "</h3>
Vielen Dank, dass Sie sich entschieden haben, unseren Dienst zu nutzen.<br />
Von nun an können Sie z.B. aktuelle Hausaufgaben einsehen.<br />
Jetzt aber viel Spa&szlig; und viel Freude mit Fabian1998.de
<p>
Ihre Login-E-Mail: " . $this->email . "
<p>
Hier k&ouml;nnen Sie sich sofort einloggen: <a href='http:\\www.fabian1998.de/kramkroae/login.php'>Zum Login</a>
</body>
</html>";
        $header = "From: Fabian1998 < noreply@fabian1998.de >\n";
        $header .= "Content-Type:text/html\n";
        $header .= "content-transfer-encoding: 8-bit\n";
        mail($receiver, $subject, $message, $header);
        header("LOCATION: index.php?screen=overview&email=$this->email");
        return true;
    }

}

?>