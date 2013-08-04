<?php

class month {

    private $timestamp;

    public function __construct($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    public function getCountOfDays(){
        return date("t", $this->timestamp);
    }
    
    public function getFirstDay(){
        return date("w", $this->timestamp);
    }
    
    public function getMonth(){
        return date("n", $this->timestamp);
    }
    
    public function getYear(){
        return date("Y", $this->timestamp);
    }
}

?>
