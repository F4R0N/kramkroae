<nav id="loginMenu">
    <div id="loginMenuContent">
        <img src="images/logo.jpg" alt="Logo"/> 
        <form name="login" method="POST">
            E-Mail: <input type="email" name="loginEmail" value="<?= $VARS["Email"] ?>"/>
            Passwort: <input type="password" name="loginPass"/>
            E-Mail merken: <input type="checkbox" name="rememberEmail" <?= $VARS["Checked"] ?>/>
            <button type="submit" name="loginButton">Login</button>
        </form>
    </div>
</nav>
<div id="content">
    <div id="contentPic">
        <img src="/images/HAJC2-B.png" alt="indexPic" />
    </div>
    <div id="contentText">
        <a href="index.php?screen=registry&mode=user">
            <div id="registryUser">
                <h4>Registrierung f&uuml;r Sch&uuml;ler und Studenten</h4>
                Registrieren Sie sich jetzt und genie&szlig;en
                Sie alle Vorteile von fabian1998.de!
            </div>
        </a>
        <a href="index.php?screen=registry&mode=school">
            <div id="registrySchool">
                <h4>Registrierung f&uuml;r Bildungseinrichtungen</h4>
                Registrieren Sie jetzt Ihre Bildungseinrichtung, 
                damit Ihre gesamte Einrichtung die Funktionen nutzen k&ouml;nnen!
            </div>
        </a>
    </div>
</div>