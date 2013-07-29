<?php

class homework {
    private $subject;
    private $homework;
    private $from;
    private $to;
    
    public function __construct($subject, $homework, $from, $to) {
        $this->subject = $subject;
        $this->homework = $homework;
        $this->from = $from;
        $this->to = $to;
    }
    
    public function getSubject(){
        return $this->subject;
    }
    
    public function getHomework(){
        return $this->homework;
    }
    
    public function getFrom(){
        return $this->from;
    }
    
    public function getTo(){
        return $this->to;
    }
}

?>
