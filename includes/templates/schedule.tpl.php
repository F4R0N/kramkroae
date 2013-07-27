<h2>Stundenplan</h2>
<table border="0">
    <thead>
        <?
        foreach ($VARS["scheduleHead"][0] as $thContent): ?>
            <th><?= $thContent ?></th>
        <?
        endforeach;
        ?>
    </thead>
    <tbody><? 
        for ($i = 0; $i <= 8; $i++): ?>
            <tr>
                <?
                foreach ($VARS["scheduleBody"][$i] as $lesson):
                    ?>
                    <td><?= $lesson ?></td>
                    <?
                endforeach;
                ?>
            </tr>
    <? endfor; ?>
    </tbody>
</table>
