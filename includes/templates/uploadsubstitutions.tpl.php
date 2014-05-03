<h2>Hinzuf&uuml;gen</h2>
<form action="" method="POST" accept-charset="UTF-8" style="width: 5em;">
    <input type="text" name="lesson" placeholder="Stunde">
    <select name="subject" style="padding:1em;">
        <option name="subjectID" value="0"> -- Fach -- </option>
        <?php foreach ($VARS["Subjects"] as $Subject): ?>
            <option name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
        <?php endforeach; ?>
    </select>
    <select name="type" style="padding:1em;">
        <option name="subjectID" value="0"> -- Art -- </option>
         <?php foreach ($VARS["Types"] as $Type): ?>
            <option name="type" value="<?= htmlentities($Type->ID); ?>"><?= htmlentities($Type->Type) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="teacher" placeholder="Lehrer" />
    <input type="text" name="substitute" placeholder="Vertreter" />
    <input type="date" class="datepicker" name="date" value="<?= date("Y-m-d"); ?>" placeholder="Datum: YYYY-MM-DD">
    <textarea name="comments" placeholder="Informationen"></textarea>
    <button type="submit" name="upload" value="true">Vertretung eintragen</button>
</form>