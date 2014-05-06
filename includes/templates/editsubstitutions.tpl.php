<h2>Bearbeiten</h2>
<?php foreach ($VARS["Dates"] as $date): ?>
    <h3><?= $VARS["Weekdays"][$date[0]->DateDay] ?> der <?= htmlentities($date[0]->Date) ?></h3>
    <form action="" method="POST" accept-charset="UTF-8" id="editSubs">
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
                <?php foreach ($date as $substitution): ?>
                    <tr>
                        <td><input type="date" class="datepicker" name="date[]" value="<?= htmlentities(date("Y-m-d", strtotime($substitution->Date))); ?>"></td>
                        <td><input id="editInputLesson" type="text" name="lesson[]" value="<?= htmlentities($substitution->Lesson); ?>"></td> 
                        <td><input id="editInputTeacher" type="text" name="teacher[]" value="<?= htmlentities($substitution->Teacher); ?>"></td>
                        <td><input id="editInputSub" type="text" name="substitute[]" value="<?= htmlentities($substitution->Substitute); ?>"></td>
                        <td><select id="editSelectSubject" name="subject[]">
                                <?php foreach ($VARS["Subjects"] as $Subject): ?>
                                    <?php if ($Subject->Subject == $substitution->Subject): ?>
                                        <option selected="selected" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                                    <?php else: ?>
                                        <option  name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select></td>
                        <td>    
                            <select id="editSelectType" name="type[]">
                                <?php foreach ($VARS["Types"] as $Type): ?>
                                    <option name="type" value="<?= htmlentities($Type->ID); ?>"><?= htmlentities($Type->Type) ?></option>
                                <?php endforeach; ?>
                            </select></td>
                        <td><textarea id="editTaCommOnSub" name="comments[]"><?= htmlentities($substitution->Comments); ?></textarea></td>
                        <td><a href="?screen=substitutions&mode=edit&delete=<?= $substitution->ID ?>"><img src="/images/deleteCross.png"/></a><input name="id[]" type="hidden" value="<?= $substitution->ID ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button id="submitButton" type="submit" name="edit" value="true">Bearbeiten</button>
    </form>
<?php endforeach; ?>