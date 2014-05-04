<h2>Die aktuellen Hausaufgaben</h2>
<div id="editLink">
    <?= $VARS["EditLink"]; ?>
</div>

<?php foreach ($VARS["Homeworks"] as $homework): ?>
    <div id="tableHWSubject">
        <table>
            <tbody>
                <tr id="firstTR">
                    <td id="subject"><?= htmlentities($homework->Subject); ?></td>
                    <td></td>
                </tr>
                <tr id="secTR">
                    <td><?= htmlentities($VARS["Weekdays"][$homework->StartDay]); ?>, dem <?= htmlentities($homework->Start); ?> -></td>
                    <td><?= htmlentities($VARS["Weekdays"][$homework->EndDay]); ?>, dem <?= htmlentities($homework->End); ?></td>
                </tr>
                <tr id="thirdTR">
                    <td><?= nl2br(htmlentities($homework->Homework)); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>


<div id="lastUpdateMessage">
    Zuletzt aktualisiert am <?= htmlentities($VARS["LastUpdate"]) ?> von 
    <?= htmlentities($VARS["UpdatedBy"]->getFirstName()) ?> 
    <?= htmlentities($VARS["UpdatedBy"]->getLastName()) ?>
</div>
