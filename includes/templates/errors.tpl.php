<h2>Fehler</h2>
Es gab <?= count($VARS["Errors"]) ?> Fehler:
<ol>
<?php foreach($VARS["Errors"] as $error): ?>
    <li><?= $error ?></li>
<?php endforeach; ?>
</ol>