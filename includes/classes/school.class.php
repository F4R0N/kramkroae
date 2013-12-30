<?php

class school {
    private $mysqli;
    private $school;
            
    function __construct($ID) {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    function __destruct() {
        $this->mysqli->close();
    }
    
    function getSchoolNameByID($schoolID){
        $sql = "SELECT 
                    SchoolName
                FROM
                    Schools
                WHERE
                    ID = '" . $schoolID . "'";
        $result = $this->mysqli->query($sql);
         while ($row = $result->fetch_assoc()) {
            $schoolName = $row["SchoolName"];
        }
        return $schoolName;
    }
    
    function getClassNameByID($classID){
        $sql = "SELECT 
                    ClassName
                FROM
                    Classes
                WHERE
                    ID = '" . $classID . "'";
        $result = $this->mysqli->query($sql);
         while ($row = $result->fetch_assoc()) {
            $className = $row["ClassName"];
        }
        return $className;
    }
    
    function getHWUploadedByClassID($classID){
        $sql = "SELECT ID FROM Homeworks WHERE ClassID = '" . $classID . "'";
        $result = $this->mysqli->query($sql);
         while ($row = $result->fetch_assoc()) {
            $HWUploaded = count($row["ID"]);
        }
        return $HWUploaded;
    }
    
    function getClassRegistryDateByID($classID, $printType){        
        $sql = "SELECT                                              
                    RegistryDate 
                FROM 
                    Classes 
                WHERE 
                    ID = '" . $classID . "'";
        $result = $this->mysqli->query($sql);                       
        while ($row = $result->fetch_assoc()) {                     
            $classRDate = $row["RegistryDate"];
        }
        if($printType == 2){                                        //  $printType=2 -> 29.12.2013
            return date("d.m.Y", strtotime($classRDate));
        }else{                                                      //  $printType=1 -> 2013-12-29
            return $classRDate;                                     
        }
    }
    
    function countSubsByClassID($classID){
        $sql = "SELECT ID FROM Substitutions WHERE ClassID = '" . $classID . "'" ;
        $result = $this->mysqli->query($sql);
         while ($row = $result->fetch_assoc()) {
            $Subsploaded = count($row["ID"]);
        }
        return $Subsploaded;
    }
    
    function countClassCoursesByClassID($classID){
        $sql = "SELECT ID FROM Courses WHERE ClassIDs LIKE '%0%'";
        $result = $this->mysqli->query($sql);
         while ($row = $result->fetch_assoc()) {
            $countCourses = count($row["ID"]);
        }
        return $countCourses;
    }
}

?>