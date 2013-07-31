<h2>Hinzuf&uuml;gen</h2>
<form action="" method="POST" accept-charset="UTF-8" style="width: 5em;">
    Stunde:
    <input type="text" name="lesson" placeholder="Stunde">
    Fach:
    <select name="subject">
        <?php foreach ($VARS["Subjects"] as $Subject): ?>
            <option style="padding: 1em; background-color: <?= htmlentities($Subject->Background); ?>; color: <?= htmlentities($Subject->Color); ?>" name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
        <?php endforeach; ?>
    </select>
    Art:
    <select name="type">
         <?php foreach ($VARS["Types"] as $Type): ?>
            <option name="type" value="<?= htmlentities($Type->ID); ?>"><?= htmlentities($Type->Type) ?></option>
        <?php endforeach; ?>
    </select>
    Lehrer:
    <input type="text" name="teacher">
    Vertreter:
    <input type="text" name="substitute">
    Am: 
    <input type="date" class="datepicker" name="date" value="<?= date("Y-m-d"); ?>" placeholder="Datum: YYYY-MM-DD">
    Information: <textarea name="comments" placeholder="Bsp: Verschoben in 3. Stunde"></textarea>
    <button type="submit" name="upload" value="true">Vertretung eintragen</button>
</form>

<a href="?screen=substitutions">Zur&uuml;ck zum Vertretungsplan</a>