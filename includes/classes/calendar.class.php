<?php

class calendar {

    private $mysqli;
    private $user;
    private $lastMonth;
    private $thisMonth;
    private $nextMonth;
    private $calendar;
    private $events;
    private $errors;

    public function __construct($user, $month, $year) {
        $timestamp = mktime(0, 0, 0, $month, 1, $year);
        $this->lastMonth = new month(strtotime("last month", $timestamp));
        $this->thisMonth = new month($timestamp);
        $this->nextMonth = new month(strtotime("next month", $timestamp));

        $this->user = $user;
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    public function getCalendar() {
        $this->setDays();
        $this->setEvents();

        return $this->calendar;
    }

    private function setDays() {
        $this->setLastMonthsDays();
        $this->setThisMonthsDays();
        $this->setNextMonthsDays();
    }

    private function setLastMonthsDays() {
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfLastMonthDays = $this->getLastMonth()->getCountOfDays();

        for ($monthDay = 1; $monthDay <= $firstDayOfThisMonth; $monthDay++) {
            $this->calendar[$monthDay] = (object) array('Day' => $monthDay + $countOfLastMonthDays - $firstDayOfThisMonth, 'Month' => $this->getLastMonth()->getMonth(), 'Year' => $this->getLastMonth()->getYear(), 'Title' => array(), 'Information' => array(), 'Style' => array('otherMonth'));
        }
    }

    private function setThisMonthsDays() {
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfThisMonthDays = $this->getThisMonth()->getCountOfDays();

        for ($monthDay = 1; $monthDay <= $countOfThisMonthDays; $monthDay++) {
            $this->calendar[$firstDayOfThisMonth + $monthDay] = (object) array('Day' => $monthDay, 'Month' => $this->getThisMonth()->getMonth(), 'Year' => $this->getThisMonth()->getYear(), 'Title' => array(), 'Information' => array(), 'Style' => array('thisMonth'));
        }
    }

    private function setNextMonthsDays() {
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfThisMonthDays = $this->getThisMonth()->getCountOfDays();

        $restDays = $firstDayOfThisMonth + $countOfThisMonthDays;

        $rows = ceil($restDays / 7);

        for ($monthDay = 1; $monthDay <= ($rows * 7) - $restDays; $monthDay++) {
            $this->calendar[$monthDay + $restDays] = (object) array('Day' => $monthDay, 'Month' => $this->getNextMonth()->getMonth(), 'Year' => $this->getNextMonth()->getYear(), 'Title' => array(), 'Information' => array(), 'Style' => array('otherMonth'));
        }
    }

    public function getThisMonth() {
        return $this->thisMonth;
    }

    public function getNextMonth() {
        return $this->nextMonth;
    }

    public function getLastMonth() {
        return $this->lastMonth;
    }

    private function setEvents() {
        $this->setToday();
        $this->getEvents();

        foreach ($this->events as $event) {
            $date = explode("-", $event->Date);
            for ( $x = 0; $x <= count($this->calendar); $x ++){
          
                if( $date[2] == $this->calendar[$x]->Day && $date[1] == $this->calendar[$x]->Month && $date[0] == $this->calendar[$x]->Year){
                        $this->calendar[$x]->Title[] = $event->Title;
                        $this->calendar[$x]->Information[] = $event->Information;
                        $this->calendar[$x]->ID[] = $event->ID;
                        $this->calendar[$x]->Start[] = $event->Start;
                        $this->calendar[$x]->End[] = $event->End;
                        if (strlen($event->Style) !== 0){
                            $style = $event->Style;
                        }
                        else {
                            $style = 'termin_data_event';
                        }
                        $this->calendar[$x]->Style[] = $style; 
                }
            }
        }
    }


    private function getEvents() {
        $sql = "
            SELECT
                *
            FROM
                Events
            WHERE
                `Display` =1
            AND
                ClassID = '" . $this->user->getClassID() . "'
            OR
               ( 
                    CLassID = 0
                AND
                    SchoolID = '" . $this->user->getSchoolID() . "'
                )
            AND
                `Start` >= '" . $this->lastMonth->getYear() . "-" . $this->lastMonth->getMonth() . "-" . $this->lastMonth->getFirstDay() . "'
            AND   
                `End` <= '" . $this->nextMonth->getYear() . "-" . $this->nextMonth->getMonth() . "-" . $this->nextMonth->getCountOfDays() . "'

";

        $result = $this->mysqli->query($sql);

        while ($obj = $result->fetch_object()) {
            $date = $obj->Start;
            while ( $obj->End >= $date ){
                    $obj->Date = $date;
                    $this->events[] = (object) array("ID" => $obj->ID, "Start" => $obj->Start, "End" => $obj->End, "Date" => $date, "Title" => $obj->Title, "Information" => $obj->Information);
                    $date = date("Y-m-d", strtotime("next day", strtotime($date)));
            }
        }
    }

    private function setToday() {
        $this->events[] = (object) array('Date' => date('Y') . '-' . date('n') . '-' . date('d'), 'Style' => 'heute');
    }
    
    // EDIT FUNCTIONS
    
    public function deleteEvent($id) {
        $sql = "
            Update
                Events
            SET
                Display = 0
            WHERE
                ID = '" . $this->mysqli->real_escape_string($id) . "'
        ";

        $this->mysqli->query($sql);

        return true;
    }
    
    public function editEvent($id, $title, $info, $start, $end) {
        $this->errors = array();
        if (!$this->isDate($start) || !$this->isDate($end))
            $this->errors[] = "Ungültiges Datum!";
        if (strlen($title) <= 1)
            $this->errors[] = "Title darf nicht leer sein!";
        if (strlen($info) <= 1)
            $this->errors[] = "Information darf nicht leer sein!";

        if (count($this->errors) !== 0)
            return false;

        $sql = "
            UPDATE
                Events
            SET
                Title = '" . trim($this->mysqli->real_escape_string($title)) . "',
                Information = '" . $this->mysqli->real_escape_string($info) . "',
                Start = '" . $this->mysqli->real_escape_string($start) . "',
                End = '" . $this->mysqli->real_escape_string($end) . "',
                UpdatedBy = '" . $this->mysqli->real_escape_string($this->user->getID()) . "',
                Updated = UNIX_TIMESTAMP(NOW())
            WHERE
                ID = '" . $this->mysqli->real_escape_string($id) . "'
        ";
        print_r($sql);
        $this->mysqli->query($sql);
        return true;
    }
    
    public function addEvent($title, $info, $start, $end) {
        $this->errors = array();

        if (!$this->isDate($start) || !$this->isDate($end))
            $this->errors[] = "Ungültiges Datum!";
        if (strlen($title) <= 1)
            $this->errors[] = "Titel darf nicht leer sein!";
        if (strlen($info) <= 1)
            $this->errors[] = "Information darf nicht leer sein!";

        if (count($this->errors) !== 0)
            return false;

        $sql = "
            INSERT INTO
                Events(
                    Title,
                    Information,
                    Start,
                    End,
                    ClassID,
                    UpdatedBy,
                    Updated,
                    Display
                )
                VALUES(
                    '" . trim($this->mysqli->real_escape_string($title)) . "',
                    '" . trim($this->mysqli->real_escape_string($info)) . "',
                    '" . $this->mysqli->real_escape_string($start) . "',
                    '" . $this->mysqli->real_escape_string($end) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getClassID()) . "',
                    '" . $this->mysqli->real_escape_string($this->user->getID()) . "',
                    UNIX_TIMESTAMP(NOW()),
                    1
                );
        ";
        $this->mysqli->query($sql);

        return true;
    }
    
    private function isDate($date) {
        $tmpDate = date_parse($date);
        if (checkdate($tmpDate["month"], $tmpDate["day"], $tmpDate["year"])) {
            return true;
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}

?>