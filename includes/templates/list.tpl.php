<h2>Meine Klasse</h2>
<table border="1">
    <thead>
        <tr>
            <th>Student</th>
            <th>Letzte Aktivit&auml;t</th>
        </tr>
    </thead>
    <tbody>
        <? for($i = 0; $i < count($VARS["Cm"]); $i++){ ?>
            <tr>
                <td>
                    <?= "<a href='index.php?screen=profile?id=" . $VARS["Cm"][$i]->ID . "'>" ?>
                        <?= $VARS["Cm"][$i]->FirstName . " " . $VARS["Cm"][$i]->LastName ?>
                    </a>
                </td>
                <td><?= $VARS["Cm"][$i]->LastAction ?></td>
            </tr>
        <? } ?>
    </tbody>
</table>