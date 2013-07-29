<h2>Hausaufgaben bearbeiten</h2>

<a href="?screen=homework">Zur&uuml;ck zu den Hausaufgaben</a>
<table border="1" cellspacing="2" cellpadding="2">
    <thead>
    <th>Fach</th>
    <th>Hausaufgabe</th>
    <th>Datum</th>
    <th>&Auml;ndern</th>
</thead>
<tr>
    <? foreach ($VARS["Homeworks"] as $homework): ?>
    <form action="" method="POST" accept-charset="UTF-8">
        <td><?= htmlentities($homework->Subject) ?></td>
        <td><textarea cols="22" rows="4" name="homework"><?= htmlentities($homework->Homework) ?></textarea></td>
        <td>Von: <input type="date" name="start" class="datepicker" value="<?= htmlentities(date("Y-m-d", strtotime($homework->Start))) ?>"><br /> 
            Bis: <input type="date" name="end" class="datepicker" value="<?= htmlentities(date("Y-m-d", strtotime($homework->End))) ?>">
        </td>
        <td>
            <button type="submit" name="submit" value="<?= htmlentities($homework->ID) ?>">&Auml;ndern</button>
            <hr>
            <a href="?screen=homework&mode=edit&delete=<?= htmlentities($homework->ID) ?>">L&ouml;schen</a>
        </td>
    </form>
    </tr>
<? endforeach; ?>
</table>