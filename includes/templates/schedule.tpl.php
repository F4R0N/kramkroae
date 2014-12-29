<div id="main">
    <table>
        <thead>
            <tr>
                <th>Stunde</th>
                <th>Zeit</th>
                <th>Montag</th>
                <th>Dienstag</th>
                <th>Mittwoch</th>
                <th>Donnerstag</th>
                <th>Freitag</th>
            </tr>
        </thead>
        <tbody>
            <?php
                for($lessons = 0; $lessons <= 10; $lessons++){
                    ?>
                    <tr>
                        <td><?= $lessons+1 ?></td>
                        <td><?= $VARS["LessonTimes"][$lessons][0]; ?></td>
                        <td><?= $VARS["LessonsMonday"][$lessons][0]; ?></td>
                        <td><?= $VARS["LessonsTuesday"][$lessons][0]; ?></td>
                        <td><?= $VARS["LessonsWednesday"][$lessons][0]; ?></td>
                        <td><?= $VARS["LessonsThursday"][$lessons][0]; ?></td>
                        <td><?= $VARS["LessonsFriday"][$lessons][0]; ?></td>
                    </tr>
                    <?php
                    print_r($VARS["LessonsTuesday"][2][0]);
                }
            ?>
        </tbody>
    </table>
</div>