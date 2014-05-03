<?php

class calendar {

    private $mysqli;
    private $user;
    private $lastMonth;
    private $thisMonth;
    private $nextMonth;
    private $calendar;
    private $events;

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
            $this->calendar[$monthDay] = (object) array('Day' => $monthDay + $countOfLastMonthDays - $firstDayOfThisMonth, 'Month' => $this->getThisMonth()->getMonth(), 'Title' => array(), 'Information' => array(), 'Style' => array('otherMonth'));
        }
    }

    private function setThisMonthsDays() {
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfThisMonthDays = $this->getThisMonth()->getCountOfDays();

        for ($monthDay = 1; $monthDay <= $countOfThisMonthDays; $monthDay++) {
            $this->calendar[$firstDayOfThisMonth + $monthDay] = (object) array('Day' => $monthDay, 'Month' => $this->getThisMonth()->getMonth(), 'Title' => array(), 'Information' => array(), 'Style' => array('thisMonth'));
        }
    }

    private function setNextMonthsDays() {
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfThisMonthDays = $this->getThisMonth()->getCountOfDays();

        $restDays = $firstDayOfThisMonth + $countOfThisMonthDays;

        $rows = ceil($restDays / 7);

        for ($monthDay = 1; $monthDay <= ($rows * 7) - $restDays; $monthDay++) {
            $this->calendar[$monthDay + $restDays] = (object) array('Day' => $monthDay, 'Month' => $this->getThisMonth()->getMonth(), 'Title' => array(), 'Information' => array(), 'Style' => array('otherMonth'));
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
          
                if( $date[2] == $this->calendar[$x]->Day && $date[1] == $this->calendar[$x]->Month){
                        $this->calendar[$x]->Title[] = $event->Title;
                        $this->calendar[$x]->Information[] = $event->Information;
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
                    $this->events[] = (object) array("ID" => $obj->ID, "Date" => $date, "Title" => $obj->Title, "Information" => $obj->Information);
                    $date = date("Y-m-d", strtotime("next day", strtotime($date)));
            }
        }
    }

    private function setToday() {
        $this->events[] = (object) array('Date' => date('Y') . '-' . date('n') . '-' . date('d'), 'Style' => 'heute');
    }

}

?>