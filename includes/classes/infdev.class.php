<?php
class infdev {
    
    private $version;
    private $description;
    
    function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    function __destruct() {
        $this->mysqli->close();
    }
    
    function getOlderVersions(){
        $sql = "SELECT Version, Description FROM Versions";
        $result = $this->mysqli->query($sql);
        return $result->fetch_object();
    }
}
?>
