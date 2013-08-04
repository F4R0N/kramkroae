<?php

class calendar {

    private $mysqli;
    private $lastMonth;
    private $thisMonth;
    private $nextMonth;
    private $calendar;

    public function __construct($month, $year) {
        $timestamp = mktime(0, 0, 0, $month, 1, $year);
        $this->lastMonth = new month(strtotime("last month", $timestamp));
        $this->thisMonth = new month($timestamp);
        $this->nextMonth = new month(strtotime("next month", $timestamp));
    }

    public function getCalendar() {
        $this->setDays();
        
        return $this->calendar;
    }

    private function setDays() {
        $this->setLastMonthsDays();
        $this->setThisMonthsDays();
        $this->setNextMonthsDays();
    }
    
    private function setLastMonthsDays(){
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfLastMonthDays = $this->getLastMonth()->getCountOfDays();
        
        for ($monthDay = 1; $monthDay <= $firstDayOfThisMonth; $monthDay++) {
            $this->calendar[$monthDay] = (object) array('day' => $monthDay + $countOfLastMonthDays - $firstDayOfThisMonth, 'shortInfo' => '', 'style' => 'otherMonth');
        }
    }
    
    private function setThisMonthsDays(){
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfThisMonthDays = $this->getThisMonth()->getCountOfDays();
        
        for ($monthDay = 1; $monthDay <= $countOfThisMonthDays; $monthDay++) {
            $this->calendar[$firstDayOfThisMonth + $monthDay] = (object) array('day' => $monthDay, 'shortInfo' => '', 'style' => 'thisMonth');
        }
    }
    
    private function setNextMonthsDays(){
        $firstDayOfThisMonth = $this->getThisMonth()->getFirstDay();
        $countOfLastMonthDays = $this->getLastMonth()->getCountOfDays();
        
        $restDays = $firstDayOfThisMonth + $countOfLastMonthDays;

        $rows = ceil($restDays / 7.0);

        for ($monthDay = 1; $monthDay <= ($rows * 7) - $restDays; $monthDay++) {
            $this->calendar[$monthDay + $restDays] = (object) array('tag' => $monthDay, 'shortInfo' => '', 'style' => 'otherMonth');
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

}

?>
