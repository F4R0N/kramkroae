<h2>Meine Klasse</h2>
<table border="2">
    <thead>
        <tr>
            <th>Student</th>
            <th>Letzte Aktivit&auml;t</th>
        </tr>
    </thead>
    <tbody>
        <? for($i = 1; $i <= count($VARS["Classmates"]); $i++){ print_r($VARS["Classmates"])?>
        <? foreach($VARS["Classmates"][$i] as $student){?>
        <tr>
            <td><?= $student ?></td>
            <td></td>
        </tr>
        <?} ?>
        <?} ?>
    </tbody>
</table>