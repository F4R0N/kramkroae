<h2>Fehler</h2>
<?= count($VARS["Errors"]) ?> Fehler sind aufgetreten:
<ol>
<?php foreach($VARS["Errors"] as $error): ?>
    <li><?= $error ?></li>
<?php endforeach; ?>
</ol>