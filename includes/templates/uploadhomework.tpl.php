<h2>Hinzuf&uuml;gen</h2>
<form action="" method="POST" accept-charset="UTF-8">
    <select name="subject" id="uplSelectSubject">
        <option name="subjectID" value="<?= htmlentities($Subject->ID); ?>"> -- Fach -- </option>
        <?php foreach ($VARS["Subjects"] as $Subject): ?>
        <option name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
        <?php endforeach; ?>
    </select>
    <br/>
    <textarea id="uplTaHW" name="homework" placeholder="Hausaufgaben"></textarea>
    <br />
    <input type="date" class="datepicker" name="start" value="<?= date("Y-m-d"); ?>" placeholder="Von: YYYY-MM-DD">
    <input type="date" class="datepicker" name="end" placeholder="Bis: YYYY-MM-DD">
    <button id="uplSubmitButton" type="submit" name="upload" value="true">
        Eintragen
    </button>
</form>