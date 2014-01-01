<div id="topBar">
    <h2>Registrierung f&uuml;r Bildungseinrichtungen</h2>
    <div id="topBarLinks">
        <a href="index.php">Startseite</a>
        <a href="index.php?screen=registry&mode=user">Nutzerregistrierung</a>
        <a href="index.php?screen=terms">Vertragsbedingungen</a>
    </div>
</div>
<form method="POST" name="registry">
    <div id="registryHeader">
        <input type="text" id="schoolname" name="schoolName" placeholder="Schulname" />
        <input type="email" name="email" placeholder="E-Mail-Adresse" />
        <input type="email" name="emailCheck" placeholder="E-Mail-Adresse wiederholen" />
        <input type="password" id="password" name="password" placeholder="Passwort" />
        <input type="password" id="password" name="passwordCheck" placeholder="Passwort wiederholen" />
    </div>
    <!--
    <select name="country">
        <option value="Germany">Deutschland</option>
        <option value="Austria">&Ouml;sterreich</option>
        <option value="Switzerland">Schweiz</option>
        <option value="Lichtenstein">Lichtenstein</option>
        <option value="Luxembourg">Luxemburg</option>
        <option value="Belgium">Belgien</option>
        <option value="Italy">Italien</option>
    </select> -->
    <div id="contactPC">
        <select name="state">
            <option value="0">Bundesland</option>
            <?for($i = 0; $i < count($VARS["GStates"]); $i++){ ?>
                <?= "<option value='" . $VARS["GStates"][$i]->ID . "'>" . $VARS["GStates"][$i]->State . "</option>" ?>
            <? } ?>
        </select>
        <input type="text" id="town" name="town" placeholder="Stadt / Dorf"/>
        <input type="text" id="PC" name="postCode" placeholder="PLZ" />
    </div>
    <div id="street">
        <input type="text" id="streetname" name="street" placeholder="Stra&szlig;e" />
        <input type="text" id="streetnumber" name="streetNumber" placeholder="Hausnummer" />
    </div>
    <div id="numbers">
        <input type="tel" name="callNumber" placeholder="Telefonnummer" />
        <input type="tel" name="faxNumber" placeholder="Faxnummer (optional)" />
    </div>
    <div id="registryBottom">
        <input type="url" name="schoolWebsite" placeholder="Schulwebsite (optional)" />
    </div>
    <button type="submit" name="registerSubmit" value="1">Registrieren</button>
</form>