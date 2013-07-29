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
                <td><?= $homework->Subject; ?></td>
                <td><?= $homework->Homework; ?></td>
                <td><?= $VARS["Weekdays"][$homework->StartDay] ?> den <?= $homework->Start; ?></td>
                <td><?= $VARS["Weekdays"][$homework->EndDay]?> den <?= $homework->End; ?></td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

