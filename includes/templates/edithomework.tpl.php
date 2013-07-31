<h2>Hausaufgaben bearbeiten</h2>

<form action="" method="POST" accept-charset="UTF-8">
    <table border="1" cellspacing="2" cellpadding="2">
        <thead>
        <th>Fach</th>
        <th>Hausaufgabe</th>
        <th>Datum</th>
        <th>&Auml;ndern</th>
        </thead>
        <tr>    <? foreach ($VARS["Homeworks"] as $homework): ?>
            <td>
                <select name="subject[]">
                        <?php foreach ($VARS["Subjects"] as $Subject): ?>
                            <? if ($Subject->Subject == $homework->Subject): ?>
                                <option selected="selected" style="padding: 1em; background-color: <?= htmlentities($Subject->Background); ?>; color: <?= htmlentities($Subject->Color); ?>" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                            <? else: ?>
                                <option style="padding: 1em; background-color: <?= htmlentities($Subject->Background); ?>; color: <?= htmlentities($Subject->Color); ?>" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                            <? endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><textarea cols="22" rows="4" name="homework[]"><?= htmlentities($homework->Homework) ?></textarea></td>
                <td>Von: <input type="date" name="start[]" class="datepicker" value="<?= htmlentities(date("Y-m-d", strtotime($homework->Start))) ?>"><br /> 
                    Bis: <input type="date" name="end[]" class="datepicker" value="<?= htmlentities(date("Y-m-d", strtotime($homework->End))) ?>">
                </td>
                <td>
                    <input type="hidden" name="id[]" value="<?= $homework->ID; ?>">
                    <a href="?screen=homework&mode=edit&delete=<?= htmlentities($homework->ID) ?>">L&ouml;schen</a>
                </td>
            </tr>
        <? endforeach; ?>
    </table>        
    <button type="submit" name="edit" value="true">&Auml;ndern</button>
</form>