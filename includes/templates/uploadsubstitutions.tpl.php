<h2>Hinzuf&uuml;gen</h2>
<form action="" method="POST" accept-charset="UTF-8" id="uplSubs">
    
    <input type="text" id="inputLesson" name="lesson" placeholder="Stunde">
    <select name="subject" id="selectSubject">
        <option name="subjectID" value="0"> -- Fach -- </option>
        <?php foreach ($VARS["Subjects"] as $Subject): ?>
            <option name="subjectID" value="<?= htmlentities($Subject->ID); ?>"><?= htmlentities($Subject->Subject) ?></option>
        <?php endforeach; ?>
    </select>
    <select name="type" id="selectType">
        <option name="subjectID" value="0"> -- Art -- </option>
         <?php foreach ($VARS["Types"] as $Type): ?>
            <option name="type" value="<?= htmlentities($Type->ID); ?>"><?= htmlentities($Type->Type) ?></option>
        <?php endforeach; ?>
    </select>
    
    <br />
    
    <input type="text" name="teacher" placeholder="Lehrer" id="inputTeacher"/>
    <input type="text" name="substitute" placeholder="Vertreter" id="inputSub"/>
    
    <br />
    
    <textarea id="taInfo" name="comments" placeholder="Informationen"></textarea>
    
    <br />

    <input id="inputDate" type="date" class="datepicker" name="date" value="<?= date("Y-m-d"); ?>" placeholder="Datum: YYYY-MM-DD">
    <button id="submitButton" type="submit" name="upload" value="true">Vertretung eintragen</button>
</form>