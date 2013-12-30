<!-- %SCHULE%-Gymnasium -->
<!-- Klasse %KLASSE% -->
<!-- Registriert seit: 1.3.37 -->
<!-- HA hochgeladen: 1337 -->
<!-- VP hochgeladen: 69 -->
<!-- angemeldete Kurse in dieser Klasse: 5 -->
<!-- Stundenanzahl pro Woche: 42 -->
<h1><?= $VARS["className"] ?></h1>
<h3><?= $VARS["schoolName"] ?></h3>
<table id="profileTable">
    <tbody>
        <tr>
            <td>Registriert seit:</td>
            <td><?= $VARS["classRDate"] ?></td>
        </tr>
        <tr>
            <td>Gesamtzahl Registrierter:</td>
            <td><?= $VARS["countCM"] ?></td>
        </tr>
        <tr>
            <td>Hausaufgaben hochgeladen:</td>
            <td><?= $VARS["HWUploaded"] ?></td>
        </tr>
        <tr>
            <td>Vertretungsplan aktualisiert:</td>
            <td><?= $VARS["subsUploaded"] ?></td>
        </tr>
        <tr>
            <td>angem. Kurse in dieser Klasse:</td>
            <td><?= $VARS["countCourses"] ?>$</td>
        </tr>
        <tr>
            <td>Stunden/Woche:</td>
            <td>42</td>
        </tr>
    </tbody>
</table>