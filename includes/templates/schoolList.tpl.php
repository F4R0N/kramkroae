<h2>Meine Schule</h2>
<table border="1">
    <thead>
        <tr>
            <th>Nummer</th>
            <th>Klasse</th>
        </tr>
    </thead>
    <tbody>
        <? for($i = 0; $i < count($VARS["Classes"]); $i++){ ?>
            <tr>
                <td>
                    <?= $i+1 ?>
                </td>
                <td>
                    <?= $VARS["Classes"][$i]->ClassName ?>
                </td>
            </tr>
        <? } ?>
    </tbody>
</table>