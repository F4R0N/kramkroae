<h2>Die aktuellen Hausaufgaben</h2>
Zuletzt aktualisiert am <?= $VARS["LastUpdate"] ?> von <?= $VARS["UpdatedBy"]->getFirstName() ?> <?= $VARS["UpdatedBy"]->getLastName() ?> <?= $VARS["EditLink"]; ?>
<table class="tablestyle" cellspacing="1" cellpadding="10">
    <thead>
        <tr>
            <td>Fach</td>
            <td>Hausaufgabe</td>
            <td>Vom</td>
            <td>Bis</td>
        </tr>
    </thead>
    <tbody>
        <? foreach ($VARS["Homeworks"] as $homework): ?>
            <tr>
                <td><?= htmlentities($homework->Subject); ?></td>
                <td><?= htmlentities($homework->Homework); ?></td>
                <td><?= htmlentities($VARS["Weekdays"][$homework->StartDay]); ?> den <?= htmlentities($homework->Start); ?></td>
                <td><?= htmlentities($VARS["Weekdays"][$homework->EndDay]); ?> den <?= htmlentities($homework->End); ?></td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

