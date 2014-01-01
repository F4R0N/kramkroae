<div id="topBar">
    <h2>Registrierung f&uuml;r Sch&uuml;ler und Studenten</h2> 
    <div id="topBarLinks">
        <a href="index.php">Startseite</a>
        <a href="index.php?screen=registry&mode=school">Schulregistrierung</a>
        <a href="index.php?screen=terms">Vertragsbedingungen</a>
    </div>
</div>
<form method="POST" action="" name="registry">
    <input type="text" id="name" name="firstName" placeholder="Vorname" value="<?= $VARS["firstName"] ?>" required autofocus/>
    <input type="text" id="name" name="lastName" placeholder="Nachname" value="<?= $VARS["lastName"]?>"required />
    <br />

    <input type="email" id="email" name="email" placeholder="E-Mail-Adresse" value="<?= $VARS["email"]?>" required/>
    <input type="email" id="email" name="emailCheck" placeholder="E-Mail-Adresse wiederholen" value="<?= $VARS["emailCheck"]?>" required/>
    <br />

    <input type="password" id="password" name="password" placeholder="Passwort" required/>
    <input type="password" id="password" name="passwordCheck" placeholder="Passwort wiederholen" required/>
    <br />

    <input type="text" name="schoolID" id="schoolID" placeholder="Bildungseinrichtung" required autocomplete="off"/>
    <div id="schools"></div>
    
    <div id="registryBottom">
        <input type="radio" required id="dame" name="gender" value="1" <?= $VARS["checkedOne"]?>/><label for="dame">Weiblich</label>
        <input type="radio" required id="herr" name="gender" value="0" <?= $VARS["checkedZero"]?>/><label for="herr">M&auml;nnlich</label>
        <br />

        <input type="checkbox" id="terms" name="acceptTerms" required value="1"/>
        <label for="terms">
            Ich stimme den <a href="index.php?screen=terms">AGBs</a> zu!
        </label>
        <br />
        <button type="submit" name="registerSubmit" value="1">Registrieren</button>
    </div>
</form>
<script>
    var onjson = false;
    $(document).ready(
            function() {
                $("#schoolID").bind({
                    keyup: function(e) {
                        var value = $(this).val();
                        if (value.length !== 0 && !onjson) {
                            onjson = true;
                            $.getJSON("/json.php?schoolName=" + value, function(data) {
                                $("#schools data").remove();
                                if (data !== null) {
                                    for (var i = 0; i < data.length; i++) {
                                        $("#schools").append("<data id='schoolID' data-ID='" + data[i].ID + "' data-SchoolName='" + data[i].SchoolName + "'>" + data[i].SchoolName + "</data>");
                                    }
                                    $("#schools #schoolID").bind({
                                        click: function(e) {
                                            var ID = $(this).data("id");
                                            var Name = $(this).data("schoolname");
                                            console.log(ID);
                                            $("#schoolID").after("<div class='schoolName'>" + Name + "</div>" +
                                                    "<input type='hidden' name='schoolID' value='" + ID + "'>");
                                            $("#schoolID").remove();
                                            $("#schools #schoolID").unbind();
                                            $("#schools").remove();
                                        }
                                    });
                                } else {

                                }
                                onjson = false;
                            });
                        }
                    }
                });
            });

</script>