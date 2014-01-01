<?php

class pwforgot {

    public $mysqli;
    public $email;
    public $lolzRoflxD;
    public $errors = array();
    private $vorname;
    private $nachname;
    private $password;

    function __construct() {
        $this->email = $_POST["email"];
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function findEmailInDB() {
        $sql = "SELECT
                    FirstName,
                    LastName
                FROM
                    Users
                WHERE
                    Email = '" . $this->email . "'
                ";
        $result = $this->mysqli->query($sql);
        if ($obj = $result->fetch_object()) {
            $this->vorname = $obj->FirstName;
            $this->nachname = $obj->LastName;
            return true;
        }
        return false;
    }

    private function createSecCo() {
        $rand = rand(0, pow(PW_BASE_POWER, PW_EXP_POWER));
        $this->lolzRoflxD = hash(PW_FORGOT_HASH, $rand);
        if ($this->lolzRoflxD) {
            return true;
        }
    }

    private function updateSecCo() {
        $sql = "UPDATE
                    Users
                SET
                    SecurityCode = '" . $this->lolzRoflxD . "'
                WHERE
                    Email = '" . $this->email . "'
                ";
        if ($result = $this->mysqli->query($sql)) {
            return true;
        }
    }

    private function sendMail() {
        $receiver = $this->email;
        $subject = "Kramkroae - Passwort vergessen";
        $message = "<html>
                        <h3>Passwort&auml;nderung - Kramkroae</h3>
                        $this->nachname $this->nachname,
                        
                        Sie haben k&uuml;rzlich eine Passwort&auml;nderunganfrage 
                        an uns verschickt!</p>
                        Klicken Sie den folgenden Link, um das Passwort neu zu vergeben: 
                        <a href='kramkroae.local/index.php&screen=pwforgot&theCode=$this->lolzRoflxD'>
                            Neues Passwort erstellen
                        </a>
                        
                        Falls Sie dieses nicht beantragt haben, kontaktieren Sie uns bitte unter unserem 
                        <a href='kramkroae.local/index.php?'>Kontaktformular</a>!
                    </html>";
        $header = "From: Fabian1998 < noreply@fabian1998.de >\n";
        $header .= "Content-Type:text/html\n";
        $header .= "content-transfer-encoding: 8-bit\n";
        if (mail($receiver, $subject, $message, $header)) {
            return true;
        }
    }

    public function doPWForgotBeforeLink() {
        if($this->findEmailInDB()){
            if($this->createSecCo()){
                if($this->updateSecCo()){
                    $this->sendMail();
                }
            }
        }
        return true;
    }

    //////////////////////// Alles bis hier her vor derm Abschicken
    //////////////////////// Jetzt kommt alles was nach dem Linkklick passiert

    private function getEmailBySC() {
        $sql = "SELECT Email FROM Users WHERE SecurityCode = '" . $this->lolzRoflxD . "'";
        $result = $this->mysqli->query($sql);
        if ($obj = $result->fetch_object()) {
            $this->email = $obj->Email;
            return true;
        }
    }
    
    private function delSC(){
        $sql = "UPDATE Users SET SecurityCode = 0 WHERE SecurityCode = '" . $this->lolzRoflxD . "'";
        if ($result = $this->mysqli->query($sql)) {
            return true;
        }
    }
    
    private function changePW(){
        $password = explode("$", crypt($this->password, PASSWORD_SALT));
        $password = $password[PW_INDEX];
        $sql = "UPDATE Users SET Password = '" . $password . "' WHERE SecurityCode = '" . $this->lolzRoflxD . "'";
        if ($result = $this->mysqli->query($sql)) {
            return true;
        }
    }

    public function doAllAfterClick($SC, $password) {
        $this->password = $password;
        $this->lolzRoflxD = $SC;
        if($this->changePW()){
            if($this->getEmailBySC()){
                $this->delSC();
            }
        }
        return true;
    }

}

?>