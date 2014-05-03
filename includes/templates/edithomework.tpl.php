<h2>Bearbeiten</h2>

<form action="" method="POST" accept-charset="UTF-8">
    <table cellspacing="1" cellpadding="10">
            <thead>
                <tr>
                    <td>Fach</td>
                    <td>Hausaufgabe</td>
                    <td>Datum</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($VARS["Homeworks"] as $homework): ?>
                <tr>
                    <td>
                        <select id="editSelectSubject" name="subject[]">
                            <?php foreach ($VARS["Subjects"] as $Subject): ?>
                                <?php if ($Subject->Subject == $homework->Subject): ?>
                                    <option selected="selected" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                                <?php else: ?>
                                    <option name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <textarea id="editTaHW" name="homework[]"><?= htmlentities($homework->Homework); ?></textarea>
                    </td>
                    <td>
                        Von: <input type="date" name="start[]" class="datepicker" value="<?= htmlentities(date("Y-m-d", strtotime($homework->Start))) ?>"><br /> 
                        Bis: <input type="date" name="end[]" class="datepicker" value="<?= htmlentities(date("Y-m-d", strtotime($homework->End))) ?>">
                    </td>
                    <td>
                        <input type="hidden" name="id[]" value="<?= $homework->ID; ?>">
                        <a href="?screen=homework&mode=edit&delete=<?= htmlentities($homework->ID) ?>">
                            <img src="/images/deleteCross.png" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>        
    <button id="editSubmitButton" type="submit" name="edit" value="true">&Auml;ndern</button>
</form>