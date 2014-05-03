<h2>Die aktuellen Hausaufgaben</h2>
<div id="editLink">
    <?= $VARS["EditLink"]; ?>
</div>

<?php foreach ($VARS["Homeworks"] as $homework): ?>
<table id="tableHWSubject">
    <tr id="firstTR">
        <td id="subject"><?= htmlentities($homework->Subject); ?></td>
    </tr>
    <tr>
        <td><?= htmlentities($VARS["Weekdays"][$homework->StartDay]); ?>, dem <?= htmlentities($homework->Start); ?></td>
        <td>-></td>
        <td><?= htmlentities($VARS["Weekdays"][$homework->EndDay]); ?>, dem <?= htmlentities($homework->End); ?></td>
    </tr>
    <tr>
        <td><?= nl2br(htmlentities($homework->Homework)); ?></td>
    </tr>
</table>
<?php endforeach; ?>


<div id="lastUpdateMessage">
    Zuletzt aktualisiert am <?= htmlentities($VARS["LastUpdate"]) ?> von 
    <?= htmlentities($VARS["UpdatedBy"]->getFirstName()) ?> 
    <?= htmlentities($VARS["UpdatedBy"]->getLastName()) ?>
</div>
