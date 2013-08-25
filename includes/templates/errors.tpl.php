<h2>Fehler</h2>
<?= count($VARS["Errors"])?> Fehler
<? if(count($VARS["Errors"]) == 1){ ?>
    ist
<? }else{
    ?> sind <?
} ?>aufgetreten:
<ol>
<?php foreach($VARS["Errors"] as $error): ?>
    <li><?= $error ?></li>
<?php endforeach; ?>
</ol>