<div id="topBar">
    <h2>LogIn nicht m&ouml;glich? - <?= $VARS["Title"] ?></h2>
    <div id="topBarLinks">
        <a href="index.php">Startseite</a>
    </div>
</div>
<div id="article">
    <form name="pwforgot" method="POST">
        <input type="email" placeholder="Ihre E-Mail-Adresse, die Sie zum Login verwenden" name="email" />
        <button type="submit" name="requestPW" value="true">Neues Passwort anfordern</button>
        <?= $VARS["firstDisplay"] ?>
    </form>
</div>
