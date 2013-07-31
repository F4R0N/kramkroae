<h2>Die aktuellen Hausaufgaben</h2>
Zuletzt aktualisiert am <?= htmlentities($VARS["LastUpdate"]) ?> von <?= htmlentities($VARS["UpdatedBy"]->getFirstName()) ?> <?= htmlentities($VARS["UpdatedBy"]->getLastName()) ?> <?= $VARS["EditLink"]; ?>
<table class="tablestyle" cellspacing="1" cellpadding="10">
    <thead>
        <tr>
            <td>Fach</td>
            <td>Hausaufgabe</td>
            <td>Von</td>
            <td>Bis</td>
        </tr>
    </thead>
    <tbody>
        <? foreach ($VARS["Homeworks"] as $homework): ?>
            <tr>
                <td><?= htmlentities($homework->Subject); ?></td>
                <td><?= nl2br(htmlentities($homework->Homework)); ?></td>
                <td><?= htmlentities($VARS["Weekdays"][$homework->StartDay]); ?>, dem <?= htmlentities($homework->Start); ?></td>
                <td><?= htmlentities($VARS["Weekdays"][$homework->EndDay]); ?>, dem <?= htmlentities($homework->End); ?></td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

