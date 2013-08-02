<?php

class schoolRegistry {
    
    private $mysqli;
    private $schoolName;
    private $password;
    private $countryID = 1;
    private $state;
    private $town;
    private $postcode;
    private $street;
    private $streetNumber;
    private $callNumber;
    private $faxNumber;
    private $email;
    private $schoolWebsite;
    private $errors = array();
    
    public function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }
    
    public function __destruct() {
        $this->mysqli->close();
    }
    
    public function getRegistryValues(){
        $this->schoolName = $this->mysqli->real_escape_string(trim($_POST["schoolName"]));
        $this->password = $this->mysqli->real_escape_string(trim($_POST["password"]));
        $this->state = $this->mysqli->real_escape_string(trim($_POST["state"]));
        $this->town = $this->mysqli->real_escape_string(trim($_POST["town"]));
        $this->postcode = $this->mysqli->real_escape_string(trim($_POST["postcode"]));
        $this->street = $this->mysqli->real_escape_string(trim($_POST["street"]));
        $this->streetNumber = $this->mysqli->real_escape_string(trim($_POST["streetNumber"]));
        $this->callNumber = $this->mysqli->real_escape_string(trim($_POST["callNumber"]));
        $this->faxNumber = $this->mysqli->real_escape_string(trim($_POST["faxNumber"]));
        $this->email = $this->mysqli->real_escape_string(trim($_POST["email"]));
        $this->schoolWebsite = $this->mysqli->real_escape_string(trim($_POST["schoolWebsite"]));
    }
    
    public function checkIfErrors() {
        $this->checkEmail();
        $this->checkPC();
        $this->checkState();
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
        $password = explode("$", crypt($this->password, SCHOOL_PASSWORD_SALT));
        $password = $password[4];
        $sql = "INSERT INTO
                    Schools (SchoolName, 
                            Password,
                            CountryID, 
                            StateID, 
                            Town, 
                            Sreet,
                            StreetNumber, 
                            Postcode, 
                            SchoolWebsite,
                            CallNumber,
                            FaxNumber,
                            Email)
                VALUES
                    ('" . $this->mysqli->real_escape_string(ucfirst($this->schoolName)) . "',
                    '" . $this->mysqli->real_escape_string(ucfirst($this->password)) . "',
                    '" . $this->mysqli->real_escape_string(ucfirst($this->countryID)) . "',
                    '" . $this->mysqli->real_escape_string($this->state) . "',
                    '" . $this->mysqli->real_escape_string($this->town) . "',
                    '" . $this->mysqli->real_escape_string($this->street) . "',
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
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    private function sendRegistryEmail(){
        
    }
    
    private function checkState(){
        $sql="SELECT ID FROM States WHERE ID = '" . $this->state . "'";
        $result = $this->mysqli->query($sql);
        $obj = $result->fetch_object;
        $stateID = $obj->ID;
        if($stateID < 1 || $stateID > 16){
           $this->errors[1] = "Bitte ein gegebenes Bundesland ausw&auml;hlen!"; 
        }
        return true;
    }
    
    private function checkPC(){
        if(strlen($this->postcode) > 5){
            $this->errors[2] = "Die Postleitzahl darf h&ouml;chstens 5 Stellen haben!";
        }
        return true;
    }
    
    private function checkEmail(){
         if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[3] = "Bitte eine g&uuml;ltige E-Mail-Adresse angeben!";
        }
        return true;
    }
    
    private function checkURL(){
        if(!filter_var($this->schoolWebsite, FILTER_VALIDATE_URL)){
            $this->errors[4] = "Bitte eine g&uuml;ltige URL angeben!";
        }
        return true;
    }
}

?>
