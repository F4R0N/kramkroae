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
                    <td><a href="index.php?screen=pwforgot">Passwort vergessen?</a></td>
                </tr>
            </table>
        </form>
    </div>
</nav>
<div id="content">
    <table>
        <tr>
            <td>
                <div id="contentPic">
                    <img src="/images/HAJC2-B.png" alt="indexPic" />
                </div>
            </td>
            <td>
                <div id="contentText">
                    <a href="index.php?screen=registry&mode=user">
                        <div id="registryUser">
                            <h1>Hier registrieren</h1>
                        </div>
                    </a>
                    <?php
                    /*
                      <a href="index.php?screen=registry&mode=school">
                      <div id="registrySchool">
                      <h4>Registrierung f&uuml;r Bildungseinrichtungen</h4>
                      Hier registrieren Sie Ihre Bildungseinrichtung, um Ihren
                      Studenten die M&ouml;glichkeit zu geben, alle Funktionen
                      unserer Seite nutzen zu k&ouml;nnen!
                      </div>
                      </a>
                     */
                    ?>
                </div>
            </td>
        <tr>
    </table>
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