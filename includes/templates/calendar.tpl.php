
<h2><?= $VARS["month"][$VARS["thisMonth"] -1] ?>  <?= $VARS["thisYear"] ?></h2>
<div style="width: 100%">
    <a class="monat_wahl_vorher" href="?screen=calendar&month=<?= $VARS["lastMonth"] ?>&year=<?= $VARS["lastYear"] ?>"><?= $VARS["month"][$VARS["lastMonth"] -1] ?></a>
    <a class="monat_wahl_weiter" href="?screen=calendar&month=&month=<?= $VARS["nextMonth"] ?>&year=<?= $VARS["nextYear"] ?>"><?= $VARS["month"][$VARS["nextMonth"] -1] ?></a></div>

<table cellspacing="10" border="2" align="center">
    <tr>
        <?php foreach ($VARS["days"] as $day): ?>
            <td class="termin_days"><?= $day ?></td>
        <?php endforeach; ?>
    </tr>

    <?php for ($z = 0; $z < count($VARS["calendar"]) / 7; $z++): ?>
        <tr>
            <?php
            for ($s = 1; $s <= 7; $s++):
                $day = $s + ($z * 7)
                ?>

                <td class="termin_data <?php foreach( $VARS["calendar"][$day]->Style as $class ): ?>  <?= $class ?><?php endforeach; ?>">
                    <?php for($i = 0; $i <= count($VARS["calendar"][$day]->Title); $i ++): ?>
                        <div class="termin_data_info_short">

                            <div class="Title">
                                <a href="#info<?= $VARS["calendar"][$day]->ID[$i] ?>"> <?= $VARS["calendar"][$day]->Title[$i] ?></a>
                            </div>

                        </div>
                        <div class="popUps" id="info<?= $VARS["calendar"][$day]->ID[$i] ?>">
                            <a href="#nonsense">⬅ Zur&uuml;ck</a>
                          
                            <h2><?= $VARS["calendar"][$day]->Title[$i] ?></h2>
                            
                            <div class="Date">
                                vom <?= date("d.m.Y", strtotime($VARS["calendar"][$day]->Start[$i])) ?> bis zum 
                                <?= date("d.m.Y", strtotime($VARS["calendar"][$day]->End[$i])) ?>
                            </div>
                            
                            <div class="Information">
                                <?= $VARS["calendar"][$day]->Information[$i] ?>
                            </div>
                            
                            <?php if ($VARS["editRight"]): ?>
                            <form method="POST" action="index.php?screen=calendar&mode=edit">
                                Titel: <input type="text" name="Title" value="<?= $VARS["calendar"][$day]->Title[$i] ?>">
                                Information: <input type="text" name="Information" value="<?= $VARS["calendar"][$day]->Information[$i] ?>">
                                Start: <input type="date" name="Start" class="datepicker" value="<?= $VARS["calendar"][$day]->Start[$i] ?>">
                                Ende: <input type="date" name="End" class="datepicker" value="<?= $VARS["calendar"][$day]->End[$i] ?>">
                                <input type="hidden" name="ID" value="<?= $VARS["calendar"][$day]->ID[$i] ?>">
                                <button type="submit" name="edit" value="True">Bearbeiten</button>
                                
                            </form>
                            <a class="eventDeleteLink" href="index.php?screen=calendar&mode=edit&delete=<?= $VARS["calendar"][$day]->ID[$i] ?>">L&ouml;schen</a>
                            <?php endif; ?>
                        </div>
                        <style>
                           #info<?= $VARS["calendar"][$day]->ID[$i] ?>:target {
                                display: block;
                            }
                        </style>
                    <?php endfor; ?>
                   <div class="termin_data_number">
                        <?= $VARS["calendar"][$day]->Day ?>
                    </div>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

<?php if ($VARS["editRight"]): ?>
<div class="popUps" id="addEvent">
    <a href="#nonsense">⬅ Zur&uuml;ck</a>

    <h2>Termin hinzuf&uuml;gen</h2>
    <form method="POST" action="index.php?screen=calendar&mode=edit">
        Titel: <input type="text" name="Title">
        Information: <input type="text" name="Information">
        Start: <input type="date" name="Start" class="datepicker">
        Ende: <input type="date" name="End" class="datepicker">
        <button type="submit" name="upload" value="True">Hochladen</button>

    </form>
</div>
<?php endif; ?>
<a href="#addEvent"> Termin hinzuf&uuml;gen </a>