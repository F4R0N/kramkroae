<h2>Vertretungsplan</h2>
<div id="editLink">
    <?= $VARS["EditLink"]; ?>
</div>
<?php foreach ($VARS["Dates"] as $date): ?>
<h3><?= $VARS["Weekdays"][$date[0]->DateDay] ?>, der <?= htmlentities($date[0]->Date) ?></h3>
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
            <?php foreach ($date as $substitution): ?>
            <tr>
                <td><?= htmlentities($substitution->Lesson); ?></td>
                <td><?= htmlentities($substitution->Teacher); ?></td>
                <td><?= htmlentities($substitution->Substitute); ?></td>
                <td><?= htmlentities($substitution->Subject); ?></td>
                <td><?= htmlentities($substitution->Type); ?></td>
                <td><?= nl2br(htmlentities($substitution->Comments)); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>
<div id="lastUpdateMessage">
    Zuletzt aktualisiert am <?= date("d.m.Y H:i",htmlentities($VARS["LastUpdate"])) ?> von 
    <?= htmlentities($VARS["UpdatedBy"]->getFirstName()) ?> <?= htmlentities($VARS["UpdatedBy"]->getLastName()) ?>
</div>