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
    private $errors;
    
   
    function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }
    
    function __destruct() {
        $this->mysqli->close();
    }
    
    function register(){
        $this->getRegistryValues();
        $this->checkNames();
        $this->checkPassword();
        $this->checkEmail();
        $this->checkGender();
        $this->checkSchoolID();
        $this->checkAcceptTerms();
        $this->intoDatabase();
        $this->sendRegistryEmail();
        
        if(count($this->errors) != 0){
            return $this->errors;
        }
        return true;
    }
    
    function getRegistryValues(){
        $this->firstName = trim($_POST["firstName"]);
        $this->lastName = trim($_POST["lastName"]);
        $this->email = trim($_POST["email"]);
        $this->emailCheck = trim($_POST["emailCheck"]);
        $this->password = trim($_POST["password"]);
        $this->passwordCheck = trim($_POST["passwordCheck"]);
        $this->gender = trim($_POST["gender"]);
        $this->schoolID = trim($_POST["schoolID"]);
        $this->acceptTerms = trim($_POST["acceptTerms"]);
        
        return true;
    }
    
    function checkNames(){
        if($this->firstName == ""){
            $this->errors[1] = "Bitte den Vornamen angeben!";
        }
        elseif(!ctype_alpha($this->firstName)){
            $this->errors[2] = "Bitte im Vornamen nur Buchstaben verwenden!";
        }
        
        if($this->lastName == ""){
            $this->errors[3] = "Bitte den Nachnamen angeben!";
        }
        elseif (!ctype_alpha($this->lastName)) {
            $this->errors[4] = "Bitte im Nachnamen nur Buchstaben verwenden!";
        }
    }
    
    function checkEmail(){
        $sql = "SELECT ID FROM Users WHERE email = " . $this->email;
        $result = $this->mysqli->query($sql);
        $number = $result->num_rows;
        
        if($this->email =""){
            $this->errors[5] = "Bitte eine E-Mail-Adresse angeben!";
        }
        elseif($number !== 0){
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
        $sql = "SELECT SchoolName FROM Schools WHERE SchoolID = " . $this->schoolID;
        $result = $this->mysqli->query($sql);
        $number = $result->num_rows;
        if($number === 1){
            return true;
        }else{
            return false;
        }
    } 
    
    function checkAcceptTerms(){
        if(!$this->acceptAGB){
            $this->errors[14] = "Bitte den Vertragsbestimmungen zustimmen!";
        }
    }
    function intoDatabase(){
        $sql = "INSERT INTO 
                    user (FirstName, LastName, Email, Password, Gender,SchoolID, AcceptTerms, RegistryDate) 
                VALUES 
                    ('" . $this->mysqli->real_escape_string($this->firstName) . "', 
                     '" . mysql_real_escape_string($this->lastName) . "', 
                     '" . mysql_real_escape_string($this->email) . "', 
                     '" . crypt(SALT, hash(HASHALG, $this->password)) . "', 
                     '" . mysql_real_escape_string($this->gender) . "', 
                     '" . mysql_real_escape_string($this->schoolID) . "', 
                     '" . mysql_real_escape_string($this->acceptTerms) . "',
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
    }
}
?>