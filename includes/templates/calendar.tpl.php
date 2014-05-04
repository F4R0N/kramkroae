
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
                            <div class="Information">
                                <?= $VARS["calendar"][$day]->Information[$i] ?>
                            </div>
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
