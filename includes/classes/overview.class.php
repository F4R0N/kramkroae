<?php

class overview {
    private $tmrwDate;
    private $tmrwHomeworks;
    private $tmrwEvents;
    private $tmrwSchedule;
    
    public function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    public function __destruct() {
        $this->mysqli->close();
    }
    
    public function getTmrw(){
        $this->tmrwDate = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
        return $this->tmrwDate;
    }
    
    public function getTmrwHomeworks(){
        $sql = "SELECT 
                    ID,
                    SubjectID,
                    Homework,
                    Subject
                FROM
                    Homeworks
                LEFT JOIN 
                    Subjects 
                ON
                    Homeworks.SubjectID = Subjects.ID 
                WHERE
                    ClassID = '" . $user->getClassID() . "'
                AND
                    END = CURDATE() + INTERVAL 1 DAY";
        $result = $this->mysqli->query($sql);
        if($result){
            return $result->fetch_object;
        }else{
            return false;
        }
    }
}

?>
