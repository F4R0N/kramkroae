<h2>Hausaufgaben hinzuf&uuml;gen</h2>
<a href="?screen=homework">Zur&uuml;ck zu den Hausaufgaben</a>
<form action="" method="POST" accept-charset="UTF-8">
    Fach:
    <select name="subject">
        <?php foreach ($VARS["Subjects"] as $Subject): ?>
        <option style="padding: 1em; background-color: <?= htmlentities($Subject->Background); ?>; color: <?= htmlentities($Subject->Color); ?>" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
        <?php endforeach; ?>
    </select>
    Von: <input type="date" class="datepicker" name="start" value="<?= date("Y-m-d"); ?>" placeholder="Datum: YYYY-MM-DD">
    Bis : <input type="date" class="datepicker" name="end" placeholder="Datum: YYYY-MM-DD">
    <textarea name="homework" placeholder="Hausaufgaben"></textarea>
    <button type="submit" name="upload" value="true">
        Hausaufgabe eintragen
    </button>
</form>