<form action="index.php?screen=schedule&mode=edit" method="GET" accept-charset="UTF-8">
    <h2>Stundenplan bearbeiten - <button type="submit" name="">&Auml;ndern</button></h2>
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
                    <td><textarea name="time[]" id="time" placeholder="10:25 - 11:10"><?= htmlentities($VARS["lesson"][$i]->Time) ?></textarea></td>
                    <?
                    for($int = 1; $int <= 7; $int++):
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
