<? 
    print_r($VARS);
    echo "<br />";
    echo "<br/>";

    $times = array();
    for($i = 1; $i <= 11; $i++){
<<<<<<< HEAD
        $time = $VARS["scheduleBody"][1][$i]->Time;
=======
        $time = $VARS["scheduleBody"][1][$i]->LessonTime;
>>>>>>> schedule
        if($time){ 
            array_push($times, $time);
        }
        $count = count($times);
    }
<<<<<<< HEAD
    echo $count;
=======
    echo "1: " . $count;
    echo "<br/>";
>>>>>>> schedule
    
    $secTimes = array();
    $secTime = $_POST[time];
    for($i = 0; $i <= 10; $i++){
        if($secTime[$i]){
            array_push($secTimes, $secTime[$i]);
        }else{
        }
    }
<<<<<<< HEAD
    echo count($secTimes);
=======
    echo "2: " . count($secTimes);
>>>>>>> schedule
    $secCount = count($secTimes);
    
    echo "<br />";
    
    if($count == $secCount){
        echo "Updaten";
    }else if($count > $secCount){
        echo "Delete";
    }else if($count < $secCount){
        echo "Insert";
    }
?>
<form action="" method="POST" accept-charset="UTF-8">
    <h2>Stundenplan bearbeiten - <button type="submit" name="editSchedule" value="true">&Auml;ndern</button></h2>
    <table border="0">
        <thead>
            <?
            foreach ($VARS["scheduleHead"][0] as $thContent): ?>
                <th><?= htmlentities($thContent) ?></th>
            <?
            endforeach;
            ?>
        </thead>
        <tbody><? 
            for ($i = 1; $i <= 11; $i++): ?>
                <tr>
                    <td><textarea name="lesson[]" id="lesson"><?= $i ?></textarea></td>
                    <td><textarea name="time[]" id="time" placeholder="10:25 - 11:10"><?= htmlentities($VARS["lesson"][$i]->LessonTime) ?></textarea></td>
                    <?
                    for($int = 1; $int <= 5; $int++):
                        ?>
                    <td><textarea name="subject[]" id="subject"><?= htmlentities($VARS["scheduleBody"][$int][$i]->Subject) ?></textarea></td>
                        <?
                    endfor;
                    ?>
                </tr>
        <? endfor; ?>
        </tbody>
    </table>
</form>
