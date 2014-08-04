<div id="topBar">
    <h2>Passwort &auml;ndern</h2>
</div>
<div id="article">
    <form name="pwforgot" method="POST">
        <input type="password" placeholder="Ihr Neues Passswort" name="newPW" /><br />
        <button type="submit" name="PWchange" value="true">Passwort aendern</button>
        <?= $VARS["PWStringAfterSuccess"]?>
    </form>
</div>
