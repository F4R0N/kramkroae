<pre><? print_r($_POST); ?></pre>
<? foreach ($VARS["Dates"] as $date): ?>
    <h3><?= $VARS["Weekdays"][$date[0]->DateDay] ?> der <?= htmlentities($date[0]->Date) ?></h3>
    <form action="" method="POST" accept-charset="UTF-8">
        <table cellspacing="1" cellpadding="10">
            <thead>
                <tr>
                    <td>Tag</td>
                    <td>Stunde</td>
                    <td>Lehrer</td>
                    <td>Vertreter</td>
                    <td>Fach</td>
                    <td>Art</td>
                    <td>Text</td>
                </tr>
            </thead>
            <tbody>
                <? foreach ($date as $substitution): ?>
                    <tr>
                        <td><input style="width: 6em;" type="date" class="datepicker" name="date[]" value="<?= htmlentities(date("Y-m-d", strtotime($substitution->Date))); ?>"></td>
                        <td><input style="width: 2em;" type="text" name="lesson[]" value="<?= htmlentities($substitution->Lesson); ?>"></td> 
                        <td><input style="width: 6em;" type="text" name="teacher[]" value="<?= htmlentities($substitution->Teacher); ?>"></td>
                        <td><input style="width: 6em;" type="text" name="substitute[]" value="<?= htmlentities($substitution->Substitute); ?>"></td>
                        <td><select name="subject[]">
                                <?php foreach ($VARS["Subjects"] as $Subject): ?>
                                    <? if ($Subject->Subject == $substitution->Subject): ?>
                                        <option selected="selected" style="padding: 1em; background-color: <?= htmlentities($Subject->Background); ?>; color: <?= htmlentities($Subject->Color); ?>" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                                    <? else: ?>
                                        <option style="padding: 1em; background-color: <?= htmlentities($Subject->Background); ?>; color: <?= htmlentities($Subject->Color); ?>" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                                    <? endif; ?>
                                <?php endforeach; ?>
                            </select></td>
                        <td>    
                            <select name="type[]">
                                <?php foreach ($VARS["Types"] as $Type): ?>
                                    <option name="type" value="<?= htmlentities($Type->ID); ?>"><?= htmlentities($Type->Type) ?></option>
                                <?php endforeach; ?>
                            </select></td>
                        <td><textarea name="comments[]"><?= htmlentities($substitution->Comments); ?></textarea></td>
                        <td><input name="id[]" type="hidden" value="<?= $substitution->ID ?>"></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
        <button type="submit" name="edit" value="true">Hochladen</button>
    </form>
<? endforeach; ?>