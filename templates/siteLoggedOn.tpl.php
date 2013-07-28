<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=320" /> <!-- So zeigt das iPhone die Website im Hochformat ohne Zoom. -->
        <meta name="viewport" content="width = 200, user-scalable = yes, initial-scale = 0.4, maximum-scale = 1 "/>
        <meta name="creator" content="Fabian H., Alexander G.">
        <meta name="author" content="Fabian H., Alexander G.">
        <meta name="description" content="Checke deine Hausaufgaben, Schultermine und Stundenplan jederzeit und überall!">
        <?php foreach ($CSSs as $CSS): ?>
            <link rel="stylesheet" href="styles/<?= $CSS['name'] ?>" type="text/css" media="<?= $CSS['media'] ?>" />
        <?php endforeach; ?>
        <?php foreach ($JSs as $JS): ?>
            <script src="<?= $JS["path"] ?>"></script>
        <?php endforeach; ?>
        <title>Home.work - <?= $VARS["Title"] ?></title>
    </head>
    <body>
        <nav id="usermenu">
            <a href="index.php?screen=overview">
                <img src="images/logo.jpg" alt="Logo" width="100px" height="35px" id="logo">
            </a>
            <nav class="links">
                <a href="index.php?logout=true">Logout</a>
                <a href="index.php?screen=message">Nachrichten (<?= $VARS["MessagesCount"] ?>)</a>
                <a href="index.php?screen=settings">Einstellungen</a>
                <a href="index.php?screen=list">Benutzerliste</a>
                <a href="index.php?screen=infdev">Entwickler Infos</a>
            </nav>
        </nav>
        <nav id="mainmenu">
            <a href="index.php?screen=profile">
                <img src="<?= $VARS["PathToUserImage"] ?>" width="80" height="80" alt="Profilbild"/>
                <h3><?= $VARS["FirstName"] . " " . $VARS ["LastName"] ?></h3>
            </a>
            <nav class='links'>
                <a href="index.php?screen=overview">News</a>
                <a href="index.php?screen=homework">Hausaufgaben</a>
                <a href="index.php?screen=schedule">Stundenplan</a>
                <a href="index.php?screen=substitutions">Vertretungsplan</a>
                <a href="index.php?screen=calendar">Kalender</a>
                <a href="index.php?screen=hwhelper">HA-Helfer</a>
            </nav>
        </nav>
        <div id="main">
            <?php
            foreach ($TPLs as $tpl) {
                include $tpl;
            }
            ?>
        </div>
    </body>
</html>