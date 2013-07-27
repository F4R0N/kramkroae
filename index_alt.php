<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css" type="text/css" />
        <link rel=”stylesheet” href=”styles/handheld.css” media=”handheld” type="text/css"/>
        <meta name="viewport" content="width=320" /> <!-- So zeigt das iPhone die Website im Hochformat ohne Zoom. -->
        <meta name = "viewport" content = "width = 200, user-scalable = yes, initial-scale = 0.4, maximum-scale = 1 "/>
        <link rel="stylesheet" media="only screen and (max-device-width: 480px)" href="styles/handheld.css" type="text/css" />
        <title>Der neue Style f&uuml;r f98.de/ha</title>
    </head>
    <body>
        <?php
        include "usermenu.php";
        include "mainmenu.php";
        ?>
        <div id="main">
            <h2>Was passiert in deiner Klasse?</h2> 
            <article id="newsfeed">	
                <section class="newStatus">
                    <div class="picture">
                        <img src="/ha/uploads/43.png" alt="Profilbild"/>
                    </div>
                    <div class="details">
                        <b>Neue Statusmeldung: </b><i>Johanna Herbst am 25. Februar 2013 um 18:46</i>
                    </div>
                    <div class="action">
                        <i>Mache gerade Hausaufgaben *h&ouml;h&ouml;*</i>
                    </div>
                    <nav class="index_post_action">
                        <div class="taetschel_button">
                            <a href="">
                                <img src="taetschel.bmp" alt="taetschel"/>
                                T&auml;tscheln
                            </a>
                        </div>
                    </nav>

                </section>

                <section class="newStatus">
                    <div class="picture">
                        <img src="/ha/uploads/1.png" alt="Profilbild"/>
                    </div>
                    <div class="details">
                        <b>Neue Statusmeldung: </b><i>Alexander Groddeck am 20. Februar 2013 um 23:23</i>
                    </div>
                    <div class="action">
                        <i>How to stun a LVL80 warlock ^^</i>
                    </div>
                    <nav class="index_post_action">
                        <div class="taetschel_button">
                            <a href="">
                                <img src="taetschel.bmp" alt="taetschel"/>
                                T&auml;tscheln
                            </a>
                        </div>
                    </nav>

                </section>

                <section class="newPic">
                    <div class="picture">
                        <img src="/ha/uploads/3.png" alt="Neues Profilbild"/>
                    </div>
                    <div class="details">
                        <b>Neues Profilbild: </b><i>Fabian Heinrich am 20. Februar 2013 um 13:37</i>
                    </div>
                    <div class="action">
                        Fabian hat sein Profilbild aktualisiert.
                    </div>
                    <nav class="index_post_action">
                        <a href="">
                            <div class="taetschel_button">
                                <img src="taetschel.bmp" alt="taetschel"/>
                                T&auml;tscheln							
                            </div>
                        </a>
                    </nav>
                </section>
            </article>
        </div>
    </body>
</html>