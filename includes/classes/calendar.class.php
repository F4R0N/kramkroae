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
            $this->calendar[$monthDay] = (object) array('Day' => $monthDay + $countOfLastMonthDays - $firstDayOfThisMonth, 'Title' => array(), 'Information' => array(), 'Style' => array('otherMonth'));
        }
    }

    private function setThisMonthsDays() {
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfThisMonthDays = $this->getThisMonth()->getCountOfDays();

        for ($monthDay = 1; $monthDay <= $countOfThisMonthDays; $monthDay++) {
            $this->calendar[$firstDayOfThisMonth + $monthDay] = (object) array('Day' => $monthDay, 'Title' => array(), 'Information' => array(), 'Style' => array('thisMonth'));
        }
    }

    private function setNextMonthsDays() {
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfThisMonthDays = $this->getThisMonth()->getCountOfDays();

        $restDays = $firstDayOfThisMonth + $countOfThisMonthDays;

        $rows = ceil($restDays / 7);

        for ($monthDay = 1; $monthDay <= ($rows * 7) - $restDays; $monthDay++) {
            $this->calendar[$monthDay + $restDays] = (object) array('Day' => $monthDay, 'Title' => array(), 'Information' => array(), 'Style' => array('otherMonth'));
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

            $start = explode('-', $event->Start);
            $end = explode('-', $event->End);
            if (count($end) == 1) {
                $end = $start;
            }

            /* if (
                    $start[1] == $this->getLastMonth()->getMonth() &&
                    $end[1] == $this->getLastMonth()->getMonth() &&
                    $start[0] == $this->getLastMonth()->getYear() &&
                    $end[0] == $this->getLastMonth()->getYear() &&
                    $end[2] > $this->getLastMonth()->getCountOfDays() - $this->getThisMonth()->getFirstDay() &&
                    $end[2] < $this->getLastMonth()->getCountOfDays()
            ) {
                $this->setEventsForMonth($event, $start, $end, 0);
            }*/
            if ($start[1] == $this->getThisMonth()->getMonth() &&
                    $end[1] == $this->getThisMonth()->getMonth() &&
                    $start[0] == $this->getThisMonth()->getYear() &&
                    $end[0] == $this->getThisMonth()->getYear()
            ) {
                $this->setEventsForMonth($event, $start, $end, $this->getThisMonth()->getFirstDay());
            }
            /*
            elseif (strtotime($event->Start) < $this->thisMonth->getTimestamp() && strtotime($event->End) > $this->thisMonth->getTimestamp())
            {
                $this->setEventsForMonth($event, $start, $end, $this->getThisMonth()->getFirstDay());
            }elseif ( strtotime($event->Start) < $this->thisMonth->getTimestamp() && strtotime($event->End) > $this->thisMonth->getTimestamp() ) {
                $this->setEventsForMonth($event, $start, $end, $this->getThisMonth()->getFirstDay());
            }*/
            /*
            if ($start[1] == $this->getNextMonth()->getMonth() &&
                    $end[1] == $this->getNextMonth()->getMonth() &&
                    $start[0] == $this->getNextMonth()->getYear() &&
                    $end[0] == $this->getNextMonth()->getYear() &&
                    $end[2] < (($this->getThisMonth()->getCountOfDays() + $this->getThisMonth()->getFirstDay()) % 7)
            ) {
                $this->setEventsForMonth($event, $start, $end, $start, $end, $this->getThisMonth()->getFirstDay() + $this->getThisMonth()->getCountOfDays());
            }
             */
        }
    }

    private function setEventsForMonth($event, $start, $end, $puffer) {
        for ($day = $start[2]; $day <= $end[2]; $day++) {
            $this->calendar[($puffer + $day)]->Title[] = $event->Title;
            $this->calendar[($puffer + $day)]->Information[] = $event->Information;
            if (strlen($event->Style) !== 0)
                $style = $event->Style;
            else
                $style = 'termin_data_event';
            $this->calendar[($puffer + $day)]->Style[] = $style;
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
        ";

        $result = $this->mysqli->query($sql);

        while ($obj = $result->fetch_object()) {
            $this->events[] = $obj;
        }
    }

    private function setToday() {
        $this->events[] = (object) array('Start' => date('Y') . '-' . date('n') . '-' . date('d'), 'Style' => 'heute');
    }

}

?>