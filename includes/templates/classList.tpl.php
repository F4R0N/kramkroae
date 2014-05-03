<h2>Meine Klasse</h2>
<table border="1">
    <thead>
        <tr>
            <th>Nummer</th>
            <th>Student</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < count($VARS["Cm"]); $i++){ ?>
            <tr>
                <td>
                    <?= $i+1 ?>
                </td>
                <td>
                    <?= $VARS["Cm"][$i]->FirstName . " " . $VARS["Cm"][$i]->LastName ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>