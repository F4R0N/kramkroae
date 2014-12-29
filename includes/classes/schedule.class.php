<?php
    class schedule{
        private $mysqli;
        private $user;
        private $LessonTimes = array();
        
        public function __construct($user) {
            $this->user = $user;
            $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        }
    }
?>