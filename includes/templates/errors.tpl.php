<h2>Fehler</h2>
<?= count($VARS["Errors"])?> Fehler
<?php if(count($VARS["Errors"]) == 1){ ?>
    ist
<?php }else{
    ?> sind <?php
} ?>aufgetreten:
<ol>
<?php foreach($VARS["Errors"] as $error): ?>
    <li><?= $error ?></li>
<?php endforeach; ?>
</ol>