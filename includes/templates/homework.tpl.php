<h2>Die aktuellen Hausaufgaben</h2>
Zuletzt aktualisiert: <?= $VARS["LastUpdate"] ?> von <?= $VARS["UpdatedBy"]->getFirstName() ?> <?= $VARS["UpdatedBy"]->getLastName() ?>
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
                <td><?= $homework->Subject; ?></td>
                <td><?= $homework->Homework; ?></td>
                <td><?= $homework->From; ?></td>
                <td><?= $homework->To; ?></td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

