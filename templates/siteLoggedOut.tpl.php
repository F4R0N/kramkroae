<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=320" /> <!-- So zeigt das iPhone die Website im Hochformat ohne Zoom. -->
        <meta name="viewport" content="width = 200, user-scalable = yes, initial-scale = 0.4, maximum-scale = 1 "/>
        <meta name="creator" content="Fabian H., Alexander G.">
        <meta name="author" content="Fabian H., Alexander G.">
        <link rel="apple-touch-icon" sizes="57x57" href="/images/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-touch-icon-114x114.png" />
        <meta name="description" content="Checke deine Hausaufgaben, Schultermine und Stundenplan jederzeit und überall!">
        <?php foreach ($CSSs as $CSS): ?>
            <link rel="stylesheet" href="styles/<?= $CSS['name'] ?>" type="text/css" media="<?= $CSS['media'] ?>" />
        <?php endforeach; ?>
        <?php foreach ($JSs as $JS): ?>
            <script src="<?= $JS["path"] ?>"></script>
        <?php endforeach; ?>
        <title>Fabian1998.de - <?= $VARS["Title"] ?></title>
    </head>
    <body>
        <div id="main">
            <?php
            foreach ($TPLs as $tpl) {
                include $tpl;
            }
            ?>
        </div>
    </body>
</html>