<h2>Registrierung f&uuml;r Bildungseinrichtungen</h2>
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
            <option value="1">Baden-Württemberg</option>
            <option value="2">Bayern</option>
            <option value="3">Berlin</option>
            <option value="4">Brandenburg</option>
            <option value="5">Bremen</option>
            <option value="6">Hamburg</option>
            <option value="7">Hessen</option>
            <option value="8">Mecklenburg-Vorpommern</option>
            <option value="9">Niedersachsen</option>
            <option value="10">Nordrhein-Westfalen</option>
            <option value="11">Rheinland-Pfalz</option>
            <option value="12">Saarland</option>
            <option value="13">Sachsen</option>
            <option value="14">Sachsen-Anhalt</option>
            <option value="15">Schleswig-Holstein</option>
            <option value="16">Th&uuml;ringen</option>
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