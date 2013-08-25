<?php

class schoolRegistry {
    
    private $mysqli;
    private $schoolName;
    private $password;
    private $passwordCheck;
    private $countryID = 1;
    private $state;
    private $town;
    private $postcode;
    private $street;
    private $streetNumber;
    private $callNumber;
    private $faxNumber;
    private $email;
    private $emailCheck;
    private $schoolWebsite;
    private $errors = array();
    
    public function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }
    
    public function __destruct() {
        $this->mysqli->close();
    }
    
    public function getGermanStates(){
        $sql = "SELECT
                    ID,
                    State
                FROM
                    States
                WHERE
                    CountryID = 1
                ORDER BY
                    State ASC
                ";
        $result = $this->mysqli->query($sql);
        while ($obj = $result->fetch_object()) {
            $States[] = $obj;
        }
        return $States;
    }
    
    public function getRegistryValues(){
        $this->schoolName = $this->mysqli->real_escape_string(trim($_POST["schoolName"]));
        $this->email = strtolower($this->mysqli->real_escape_string(trim($_POST["email"])));
        $this->emailCheck = strtolower($this->mysqli->real_escape_string(trim($_POST["emailCheck"])));
        $this->password = $this->mysqli->real_escape_string(trim($_POST["password"]));
        $this->passwordCheck = $this->mysqli->real_escape_string(trim($_POST["passwordCheck"]));
        $this->state = $this->mysqli->real_escape_string(trim($_POST["state"]));
        $this->town = $this->mysqli->real_escape_string(trim($_POST["town"]));
        $this->postcode = $this->mysqli->real_escape_string(trim($_POST["postCode"]));
        $this->street = $this->mysqli->real_escape_string(trim($_POST["street"]));
        $this->streetNumber = $this->mysqli->real_escape_string(trim($_POST["streetNumber"]));
        $this->callNumber = $this->mysqli->real_escape_string(trim($_POST["callNumber"]));
        $this->faxNumber = $this->mysqli->real_escape_string(trim($_POST["faxNumber"]));
        $this->schoolWebsite = $this->mysqli->real_escape_string(trim($_POST["schoolWebsite"]));
        return true;
    }
    
    public function checkIfErrors() {
        $this->getRegistryValues();
        $this->checkSchoolname();
        $this->checkEmail();
        $this->checkPassword();
        $this->checkState();
        $this->checkTown();
        $this->checkPC();
        $this->checkStreet();
        $this->checkStreetNumber();
        $this->checkCallNumber();
        $this->checkFaxNumber();
        $this->checkURL();
        if(count($this->errors)){
            return true;
        }
        return false;
    }
    
    public function getErrors() {
        return $this->errors;
    }
    
    public function register() {
        $this->intoDatabase();
        $this->sendRegistryEmail();
        return true;
    }
    
    private function intoDatabase(){
        $password = explode("$", crypt($this->password, PASSWORD_SALT));
        $password = $password[4];
        $sql = "INSERT INTO
                    Schools (SchoolName, 
                            Password,
                            CountryID, 
                            StateID, 
                            Town, 
                            Street,
                            StreetNumber, 
                            Postcode, 
                            SchoolWebsite,
                            CallNumber,
                            FaxNumber,
                            Email,
                            RegistryDate)
                VALUES
                    ('" . $this->mysqli->real_escape_string(ucfirst($this->schoolName)) . "',
                    '" . $this->mysqli->real_escape_string($password) . "',
                    '" . $this->mysqli->real_escape_string($this->countryID) . "',
                    '" . $this->mysqli->real_escape_string($this->state) . "',
                    '" . $this->mysqli->real_escape_string(ucfirst($this->town)) . "',
                    '" . $this->mysqli->real_escape_string(ucfirst($this->street)) . "',
                    '" . $this->mysqli->real_escape_string($this->streetNumber) . "',
                    '" . $this->mysqli->real_escape_string($this->postcode) . "',
                    '" . $this->mysqli->real_escape_string($this->schoolWebsite) . "',
                    '" . $this->mysqli->real_escape_string($this->callNumber) . "',
                    '" . $this->mysqli->real_escape_string($this->faxNumber) . "',
                    '" . $this->mysqli->real_escape_string($this->email) . "',
                    CURDATE()
                    )
                ";
        $result = $this->mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    function sendRegistryEmail() {
        $receiver = $this->email;
        $subject = "Willkommen bei Fabian1998";
        $message = "
        <html>
            <body>
                <h3>Willkommen bei Fabian1998 " . $this->schoolName . "</h3>
                Vielen Dank, dass Sie sich entschieden haben, unseren Dienst zu nutzen.<br />
                Ihre Stundenten werden Ihnes es danken!<br />
                Jetzt aber viel Spa&szlig; und viel Freude mit Fabian1998.de
                <p>
                Ihre Login-E-Mail: " . $this->email . "
                <p>
                Hier k&ouml;nnen Sie sich sofort einloggen: <a href='http:\\www.fabian1998.de/kramkroae/login.php'>Zum Login</a>
                <p>
                Falls Sie Ihr Passwort vergessen haben sollten, klicken Sie bitte hier:
                <a href='http:\\www.fabian1998.de/kramkroae/index.php?screen=forgotpw'>Passwort vergessen ?</a>
            </body>
        </html>";
        $header = "From: Fabian1998 < noreply@fabian1998.de >\n";
        $header .= "Content-Type:text/html\n";
        $header .= "content-transfer-encoding: 8-bit\n";
        mail($receiver, $subject, $message, $header);
        header("LOCATION: index.php?screen=overview&email=$this->email");
 }
    
    private function checkFaxNumber(){
        if($this->faxNumber != ""){
            if(!is_numeric ($this->faxNumber)){
                $this->errors[11] = "Faxnummer der Schule darf nur aus Zahlen bestehen!";
            }
        }
    }
    
    private function checkCallNumber(){
        if($this->callNumber == ""){
           $this->errors[10] = "Telefonnummer der Schule muss angegeben werden!"; 
        }
    }
    
    private function checkStreetNumber(){
        if($this->streetNumber == ""){
            $this->errors[9] = "Hausnummer der Schule muss angegeben werden!";
        }
    }
    
    private function checkStreet(){
        if($this->street == ""){
            $this->errors[8] = "Eine Stra&szlig;e muss angegeben werden!";
        }
        elseif(is_numeric($this->street)){
            $this->errors[8] = "Ich wette, dass in Ihrer Stra&szlig; keine Zahl vorkommt!";
        }
    }
    
    private function checkTown(){
        if($this->town == ""){
            $this->errors[7] = "Es muss eine Stadt/ein Dorf angegeben werden!";
        }
        elseif(is_numeric($this->town)){
            $this->errors[7] = "Ich wette, dass in Ihrer Stadt keine Zahl vorkommt!";
        }
    }

    private function checkPassword(){
        if($this->password == ""){
            $this->errors[6] = "Passwort muss angegeben werden!";
        }
        elseif($this->passwordCheck == ""){
            $this->errors[6] = "Passwortwiederholung muss angegeben werden!";
        }
    }

    private function checkSchoolname(){
        $sql = "SELECT
                    ID
                FROM
                    Schools
                WHERE
                    SchoolName = " . $this->schoolName . "
                AND
                    Town = " . $this->town;
        $result = $this->mysqli->query($sql);
        $obj = $result->fetch_object;
        $schoolID = $obj->ID;
        if($this->schoolName == ""){
            $this->errors[5] = "Es ist kein Schulname eingetragen worden!";
        }
        elseif($schoolID != ""){
           $this->errors[5] = "Diese Schule ist schon eingetragen worden!"; 
        }
        return true;
    }


    private function checkState(){
        if($this->state == ""){
            $this->errors[4] = "Ein Bundesland muss ausgewaehlt werden!"; 
        }
        elseif($this->state > 16 || $this->state < 1){
           $this->errors[4] = "Bitte ein gegebenes Bundesland ausw&auml;hlen!"; 
        }
        return true;
    }
    
    private function checkPC(){
        if($this->postcode == ""){
            $this->errors[3] = "Postleitzahl wurde nicht eingegeben!";
        }
        elseif(strlen($this->postcode) > 5){
            $this->errors[3] = "Die Postleitzahl darf h&ouml;chstens 5 Stellen haben!";
        }
        return true;
    }
    
    private function checkEmail() {
        $sql = "SELECT 
                    ID 
                FROM 
                    Schools 
                WHERE 
                    Email = '" . $this->email . "'
               ";
        $result = $this->mysqli->query($sql);
        $number = $result->num_rows;
        if ($this->email == "") {
            $this->errors[2] = "Bitte eine E-Mail-Adresse angeben!";
        } elseif ($number !== 0) {
            $this->errors[2] = "Die E-Mail-Adresse wird bereits verwendet!<br />
                                Bitte eine andere E-Mail-Adresse angeben!";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[2] = "Bitte eine g&uuml;ltige E-Mail-Adresse angeben!";
        } elseif ($this->email !== $this->emailCheck) {
            $this->errors[2] = "Bitte eine korrekte E-Mail-Wiederholung angeben!";
        }
        return true;
    }
    
    private function checkURL(){
        if($this->schoolWebsite != ""){
            if(!filter_var($this->schoolWebsite, FILTER_VALIDATE_URL)){
                $this->errors[1] = "Bitte eine g&uuml;ltige URL angeben!";
            }
            return true;
        }
    }
}

?>
