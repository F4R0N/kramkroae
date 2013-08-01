<?php

class schoolRegistry {
    
    private $schoolName;
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
        $this->state = $this->mysqli->real_escape_string(trim($_POST["state"]));
        $this->town = $this->mysqli->real_escape_string(trim($_POST["town"]));
        $this->postcode = $this->mysqli->real_escape_string(trim($_POST["postcode"]));
        $this->street = $this->mysqli->real_escape_string(trim($_POST["street"]));
        $this->streetNumber = $this->mysqli->real_escape_string(trim($_POST["streetNumber"]));
    }
}

?>
