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
    
    function checkIfErrors(){
        if($this->errors != ""){
            return true;
        }else{
            return false;
        }
    }
    
    function register(){
        $this->intoDatabase();
        $this->sendRegistryEmail();
    }
    
    function getRegistryValues(){
        $this->firstName = $this->mysqli->real_escape_string(trim($_POST["firstName"]));
        $this->lastName = $this->mysqli->real_escape_string(trim($_POST["lastName"]));
        $this->email = $this->mysqli->real_escape_string(trim($_POST["email"]));
        $this->emailCheck = $this->mysqli->real_escape_string(trim($_POST["emailCheck"]));
        $this->password = $this->mysqli->real_escape_string(trim($_POST["password"]));
        $this->passwordCheck = $this->mysqli->real_escape_string(trim($_POST["passwordCheck"]));
        $this->gender = $this->mysqli->real_escape_string(trim($_POST["gender"]));
        $this->schoolID = $this->mysqli->real_escape_string(trim($_POST["schoolID"]));
        $this->acceptTerms = $this->mysqli->real_escape_string(trim($_POST["acceptTerms"]));
    }
    
    function checkNames(){
        if($this->firstName == ""){
            $this->errors[1] = "Bitte den Vornamen angeben!";
        }
        elseif(!ctype_alpha($this->firstName)){
            $this->errors[2] = "Bitte im Vornamen nur Buchstaben verwenden!";
        }
        elseif($this->lastName == ""){
            $this->errors[3] = "Bitte den Nachnamen angeben!";
        }
        elseif (!ctype_alpha($this->lastName)) {
            $this->errors[4] = "Bitte im Nachnamen nur Buchstaben verwenden!";
        }
    }
    
    function checkEmail(){
        $sql = "SELECT ID FROM Users WHERE Email = " . $this->email;
        $result = $this->mysqli->query($sql);
        $number = $result->num_rows;
        
        if($this->email == ""){
            $this->errors[5] = "Bitte eine E-Mail-Adresse angeben!";
        }
        elseif($number != 0){
            $this->errors[6] = "Die E-Mail-Adresse wird bereits verwendet!<br />
                    Bitte eine andere E-Mail-Adresse angeben!";
        }
        elseif (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[7] = "Bitte eine g&uuml;ltige E-Mail-Adresse angeben!";
        }
        elseif ($this->email !== $this->emailCheck) {
            $this->errors[8] = "Bitte eine korrekte E-Mail-Wiederholung angeben!";
        }
    }
    
    function checkPassword(){
        if($this->password !== $this->passwordCheck){
            $this->errors[9] = "Bitte eine korrekte Passwortwiederholung angeben!";
        }
        elseif(strlen($this->password) < 6){
            $this->errors[10] = "Bitte ein mindestens 6-stelliges Passwort w&auml;hlen!";
        }
        elseif(ctype_alpha($this->password)){
            $this->errors[11] = "Bitte auch numerische Zahlen im Passwort verwenden!";
        }
        elseif(ctype_digit($this->password)){
            $this->errors[12] = "Bitte auch Buchstaben im Passwort verwenden!";
        }
    }
    
    function checkGender(){
        if($this->gender < 0 || $this->gender > 1){
            $this->errors[13] = "Bitte ein gegebenes Geschlecht ausw&auml;hlen!";
        }
    }
            
    function checkSchoolID(){
        $sql = "SELECT SchoolName FROM Schools WHERE ID = " . $this->schoolID;
        $result = $this->mysqli->query($sql);
        $number = $result->num_rows;
        if($number !== 1){
            $this->errors[14] = "Diese Schule wurde noch nicht eingetragen!<br />
                                Registrieren Sie <a href='index.php?screen=registry&mode=school'>HIER</a>";
        }
    } 
    
    function checkAcceptTerms(){
        if(!$this->acceptAGB){
            $this->errors[15] = "Bitte den Vertragsbestimmungen zustimmen!";
        }
    }
    function intoDatabase(){
        $sql = "INSERT INTO 
                    Users (FirstName, LastName, Email, Password, Gender,SchoolID, AcceptTerms, RegistryDate) 
                VALUES 
                    ('" . $this->mysqli->real_escape_string(ucfirst($this->firstName)) . "', 
                     '" . $this->mysqli->real_escape_string(ucfirst($this->lastName)) . "', 
                     '" . $this->mysqli->real_escape_string($this->email) . "',
                     '" . hash(PASSWORD_HASHALG, crypt(PASSWORD_SALT, $this->password)) . "',
                     '" . $this->mysqli->real_escape_string($this->gender) . "', 
                     '" . $this->mysqli->real_escape_string($this->schoolID) . "', 
                     '" . $this->mysqli->real_escape_string($this->acceptTerms) . "',
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

    function sendRegistryEmail(){
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
                            <p>
                            Falls Sie Ihr Passwort vergessen haben sollten, klicken Sie bitte hier:
                            <a href='http:\\www.fabian1998.de/kramkroae/index.php?screen=forgotpw'>Passwort vergessen ?</a>
                        </body>
                    </html>";
        $header  = "From: Fabian1998 < noreply@fabian1998.de >\n";
        $header .= "Content-Type:text/html\n";
        $header .= "content-transfer-encoding: 8-bit\n"; 
        mail($receiver, $subject, $message, $header);
        return true;
    }
}
?>