<h2>Stundenplan <?= $VARS["EditLink"] ?></h2>
<? print_r(htmlentities($VARS)) ?>
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
        for ($i = 1; $i <= htmlentities($VARS["maxLesson"]); $i++): ?>
            <tr>
                <td><?= $i ?></td>
                <td></td>
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
