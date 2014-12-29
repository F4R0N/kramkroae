<h2>Willkommen bei Kramkroae</h2>
<article>
    <table id="all">
        <tr>
            <td>
                <table id="leftTwoSections">
                    <tr>
                        <td>
                            <section class="homework">
                                <!-- sinnloser Kommentar Nr. 1 -->
                                <h3>Hausaufgaben f&uuml;r heute</h3>
                                <?php if ($VARS["countHW"] != 0) { ?>
                                    <div class="hwCard">
                                        <table class="hwInfo">
                                            <tr>
                                                <td><b>Fach</b></td> 
                                                <td><b>Hausaufgabe</b></td>
                                            </tr>
                                            <?php for ($i = 0; $i < $VARS["countHW"]; $i++) { ?>
                                                <tr>
                                                    <td><?= $VARS["hwSub"][$i] ?></td>
                                                    <td><?= nl2br($VARS["homework"][$i]) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <i>Es sind keine Hausaufgaben zu machen!</i>
                                <?php } ?>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <section class="homework">
                                <!-- sinnloser Kommentar Nr. 1 -->
                                <h3>Hausaufgaben zu morgen</h3>
                                <?php if ($VARS["countHW"] != 0) { ?>
                                    <div class="hwCard">
                                        <table class="hwInfo">
                                            <tr>
                                                <td><b>Fach</b></td> 
                                                <td><b>Hausaufgabe</b></td>
                                            </tr>
                                            <?php for ($i = 0; $i < $VARS["countHW"]; $i++) { ?>
                                                <tr>
                                                    <td><?= $VARS["hwSub"][$i] ?></td>
                                                    <td><?= nl2br($VARS["homework"][$i]) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <i>Es sind keine Hausaufgaben zu machen!</i>
                                <?php } ?>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <section id="dates">
                                <h3>anstehende Termine</h3>
                                <?php if ($VARS["countEvents"] != 0) { ?>
                                    <table class="dateTable">
                                        <?php
                                        for ($i = 0; $i < $VARS["countEvents"]; $i++) {
                                            $start = $VARS["nextEvents"][$i]->Start;
                                            $end = $VARS["nextEvents"][$i]->End;
                                            $title = $VARS["nextEvents"][$i]->Title;
                                            ?>
                                            <tr>
                                                <?php
                                                if ($start == $end) {
                                                    ?>
                                                    <td><?= $VARS["nextEvents"][$i]->Start ?></td>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td><?= $VARS["nextEvents"][$i]->Start ?></td>
                                                    <td><?= $VARS["nextEvents"][$i]->End ?></td>
                                                    <?php
                                                }
                                                ?>
                                                <td><?= $VARS["nextEvents"][$i]->Title ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php } else { ?>
                                    <i>Es liegen keine Termine an!</i>
                                <?php } ?>
                            </section>
                        </td>
                    </tr>
                </table>

            </td>
            <td>
                <section id="subjects">
                    <h3>Stundenplan</h3>
                    <table class="timetable">
                        <thead>
                        <th>Stunde</th>
                        <th>Fach</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>/</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>/</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Informatik</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Informatik</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Informatik</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Informatik</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Mathe</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Mathe</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Sport</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Sport</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>/</td>
                            </tr>
                        </tbody>
                    </table>
                </section> 
            </td>
        <tr>
    </table>
</article>