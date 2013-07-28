<?php foreach ($VARS["Errors"] as $error): ?>
    <? print $error; ?>
<?php endforeach; ?>
<h2>Registrierung</h2>
<form method="POST" action="" name="registry">
    <input type="text" id="name" name="firstName" placeholder="Vorname" required autofocus/>
    <input type="text" id="name" name="lastName" placeholder="Nachname" required />
    <br />
    
    <input type="email" id="email" name="email" placeholder="E-Mail-Adresse" required/>
    <input type="email" id="email" name="emailCheck" placeholder="E-Mail-Adresse wiederholen" required/>
    <br />
    
    <input type="password" id="password" name="password" placeholder="Passwort" required/>
    <input type="password" id="password" name="passwordCheck" placeholder="Passwort wiederholen" required/>
    <br />
    
    <input type="text" id="schoolID" list="schoolList" placeholder="W&auml;hlen Sie Ihre Ausbildungsst&auml;tte" required/>
    <datalist id="schoolList">
        <option value="-- Bitte w&auml;hlen Sie Ihre Ausbildungsst&auml;tte --">-- Bitte w&auml;hlen Sie Ihre Ausbildungsst&auml;tte --</option>
        <option value="Meine Ausbildungsst&auml;tte ist nicht gegeben">Meine Ausbildungsst&auml;tte ist nicht gegeben</option>
    	<option value="GER - Halstenbek, Wolfgang-Borchert-Gymnasium">GER - Halstenbek, Wolfgang-Borchert-Gymnasium</option>
    </datalist>
    <br />
    
    <div id="registryBottom">
        <input type="radio" required id="dame" name="gender" value="1" /><label for="dame">Weiblich</label>
        <input type="radio" required id="herr" name="gender" value="0" /><label for="herr">M&auml;nnlich</label>
        <br />

        <input type="checkbox" id="terms" name="acceptTerms" required value="1"/>
        <label for="terms">
            Ich stimme den <a href="">AGBs</a> zu!
        </label>
        <br />
        <button type="submit" name="registerSubmit" value="1">Registrieren</button>
    </div>
</form>