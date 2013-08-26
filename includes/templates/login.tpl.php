<nav id="loginMenu">
    <div id="loginMenuContent">
        <div id="domainLogo">F98.DE/HA</div>
        <form name="login" method="POST">
            <table>
                <tr>
                    <td><input type="email" placeholder="E-Mail-Adresse" name="loginEmail" value="<?= $VARS["Email"] ?>"/></td>
                    <td><input type="password" placeholder="Passwort" name="loginPass"/></td>
                    <td><button type="submit" name="loginButton">Login</button></td>
                </tr>
                <tr id="subLogin">
                    <td>E-Mail merken: <input type="checkbox" name="rememberEmail" <?= $VARS["Checked"] ?>/></td>
                    <td><a href="">Passwort vergessen?</a></td>
                </tr>
            </table>
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
                Registrieren Sie sich jetzt mit Ihrer Bildungseinrichtung
                und profitieren Sie von den Funktionen unserer Seite!
            </div>
        </a>
        <a href="index.php?screen=registry&mode=school">
            <div id="registrySchool">
                <h4>Registrierung f&uuml;r Bildungseinrichtungen</h4>
                Hier registrieren Sie Ihre Bildungseinrichtung, um Ihren
                Studenten die M&ouml;glichkeit zu geben, alle Funktionen 
                unserer Seite nutzen zu k&ouml;nnen!
            </div>
        </a>
    </div>
</div>
<footer>
    <a href="" class="footerLink">
        Kontaktformular
    </a>
    <a href="?screen=terms" class="footerLink">
        Vertragsbedingungen
    </a>
    <a href="?screen=legNotice" class="footerLink">
        Impressum
    </a>
</footer>