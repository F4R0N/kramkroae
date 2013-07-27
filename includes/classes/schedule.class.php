<?php

class schedule {

    function getScheduleTbody() {
        $schedule = array(
            array('1.', '7:45 - 8:30', 'Sport', 'Englisch', 'Englisch', 'Sport', 'Englisch', 'Englisch', 'Englisch'),
            array('2.', '8:35 - 9:20', 'Sport', 'Sport', 'Sport', 'Sport', 'Sport', 'Sport', 'Sport'),
            array('3.', '9:35 - 10:20', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde', 'Erdkunde'),
            array('4.', '10:25 - 11:10', 'Informatik', 'Informatik', 'Informatik', 'Informatik', 'Informatik', 'Informatik', 'Informatik'),
            array('5.', '11:25 - 12:10', 'Biologie', 'Biologie', 'Biologie', 'Biologie', 'Biologie', 'Biologie', 'Biologie'),
            array('6.', '12:15 - 13:00', 'Musik', 'Musik', 'Musik', 'Musik', 'Musik', 'Musik', 'Musik'),
            array('7.', '13:20 - 14:05', 'Mathe', 'Mathe', 'Mathe', 'Mathe', 'Mathe', 'Mathe', 'Mathe'),
            array('8.', '14:10 - 14:55', 'Physik', 'Physik', 'Physik', 'Physik', 'Physik', 'Physik', 'Physik'),
            array('9.', '15:00 - 15:45', 'Chemie', 'Chemie', 'Chemie', 'Chemie', 'Chemie', 'Chemie', 'Chemie')
        );
        return $schedule;
    }

    function getScheduleThead() {
        $scheduleThead[] = array("Stunde", "Uhrzeit", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
        return $scheduleThead;
    }

}

?>
