<p>current build: <?= $VARS["version"];?></p>
<h3>&auml;ltere Versionen</h3>
<table>
    <thead>
        <th>
            <td>Version</td>
            <td>Beschreibung</td>
        </th>
    </thead>
    <tbody>
        <?
        while ($row = getOlderVersions()) {
            ?>
            <tr>
                <td><?= $VARS["olderVersion"];?></td>
                <td><?= $VARS["olderDescription"];?></td>
            </tr>
            <?
        }
        ?>
    </tbody>
</table>