<h2>Was steht morgen <?= $VARS["tomorrowDay"] ?>, dem <?= $VARS["tomorrowDate"]; ?>, an?</h2>
<article>
    <table id="all">
        <tr>
            <td>
                <section id="dates">
                    <h3>Termine</h3>
                    <?php if($VARS["countEvents"] != 0){ ?>
                        <table class="dateTable">
                            <?php  for($i = 0; $i < $VARS["countEvents"]; $i++){ 
                                $start = $VARS["nextEvents"][$i]->Start;
                                $end = $VARS["nextEvents"][$i]->End;
                                $title = $VARS["nextEvents"][$i]->Title;
                            ?>
                            <tr>
                                <?php
                                    if($start == $end){
                                        ?>
                                        <td><?= $VARS["nextEvents"][$i]->Start ?></td>
                                        <?php
                                    }else{
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
                    <?php }else{ ?>
                    <i>Es liegen keine Termine an!</i>
                    <?php } ?>
                </section>
            </td>
            <td>
                <section id="homework">
                    <h3>Hausaufgaben</h3>
                    <?php if($VARS["countHW"] != 0){ ?>
                    <div class="hwCard">
                        <table class="hwInfo">
                            <tr>
                                <td><b>Fach</b></td> 
                                <td><b>Hausaufgabe</b></td>
                            </tr>
                            <?php  for($i = 0; $i < $VARS["countHW"]; $i++){ ?>
                            <tr>
                                <td><?= $VARS["hwSub"][$i] ?></td>
                                <td><?= nl2br($VARS["homework"][$i]) ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <i>Es sind keine Hausaufgaben zu machen!</i>
                    <?php } ?>
                </section>
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
                                <td>Deutsch</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Deutsch</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Mathe</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>kath. Religion</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>kath. Religion</td>
                            </tr>
                        </tbody>
                    </table>
                </section> 
            </td>
        </tr>
    </table>
</article>