<h2>Vertretungsplan</h2>
Zuletzt aktualisiert am <?= htmlentities($VARS["LastUpdate"]) ?> von <?= htmlentities($VARS["UpdatedBy"]->getFirstName()) ?> <?= htmlentities($VARS["UpdatedBy"]->getLastName()) ?> <?= $VARS["EditLink"]; ?>
<? foreach ($VARS["Dates"] as $date): ?>
<h3><?= $VARS["Weekdays"][$date[0]->DateDay] ?> der <?= htmlentities($date[0]->Date) ?></h3>
    <table cellspacing="1" cellpadding="10">
        <thead>
            <tr>
                <td>Stunde</td>
                <td>Lehrer</td>
                <td>Vertreter</td>
                <td>Fach</td>
                <td>Art</td>
                <td>Text</td>
            </tr>
        </thead>
        <tbody>
            <? foreach ($date as $substitution): ?>
            <tr>
                <td><?= htmlentities($substitution->Lesson); ?></td>
                <td><?= htmlentities($substitution->Teacher); ?></td>
                <td><?= htmlentities($substitution->Substitute); ?></td>
                <td><?= htmlentities($substitution->Subject); ?></td>
                <td><?= htmlentities($substitution->Type); ?></td>
                <td><?= htmlentities($substitution->Comments); ?></td>
            </tr>
            <? endforeach; ?>
        </tbody>
    </table>
<? endforeach; ?>