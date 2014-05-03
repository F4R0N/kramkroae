<h2>Stundenplan <?= $VARS["EditLink"] ?></h2>
<? print_r($VARS) ?>
<table border="0" id="schedule">
    <thead>
        <?
        foreach ($VARS["scheduleHead"][0] as $thContent): ?>
            <th><?= htmlentities($thContent) ?></th>
        <?
        endforeach;
        ?>
    </thead>
    <tbody><? 
        for ($i = 1; $i <= htmlentities($VARS["maxLesson"]); $i++): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlentities($VARS["lesson"][$i]->LessonTime) ?></td>
                <?
                for($int = 1; $int <= htmlentities($VARS["maxDay"]); $int++):
                    ?>
                    <td><?= htmlentities($VARS["scheduleBody"][$int][$i]->Subject) ?></td>
                    <?
                endfor;
                ?>
            </tr>
    <? endfor; ?>
    </tbody>
</table>
