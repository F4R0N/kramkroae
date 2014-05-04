<h2>Die aktuellen Hausaufgaben</h2>
<div id="editLink">
    <?= $VARS["EditLink"]; ?>
</div>
<div id="allCards">
    <?php foreach ($VARS["Homeworks"] as $homework): ?>
        <div id="hwCard">
            <div id="firstDiv">
                <?= htmlentities($homework->Subject); ?>
            </div>
            <div id="secDiv">
                <?= htmlentities($VARS["Weekdays"][$homework->StartDay]); ?> - <?= htmlentities($homework->Start); ?>
                &rarr;
                <?= htmlentities($VARS["Weekdays"][$homework->EndDay]); ?> - <?= htmlentities($homework->End); ?>
            </div>
            <div id="thirdDiv">
                <?= nl2br(htmlentities($homework->Homework)); ?>
            </div>
        </div>
    <?php endforeach; ?>
    <div id="lastUpdateMessage">
        Zuletzt aktualisiert am <?= htmlentities($VARS["LastUpdate"]) ?> von 
        <?= htmlentities($VARS["UpdatedBy"]->getFirstName()) ?> 
        <?= htmlentities($VARS["UpdatedBy"]->getLastName()) ?>
    </div>
</div>