<pre>
    <?php print_r($_POST); ?>
</pre>
<?php
include_once 'classes/registry.class.php';

$registry = new registry();

if (isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1) {
    if (!$registry->checkIfErrors()) {
        $registry->register();
        echo "Erfolgreich registriert!";
    }else{
        echo "Registrierung fehlgeschlagen!";
        $registry->echoErrors();
    }
}
$tpl->addMainTemplate("registry.tpl.php");
$tpl->addCss(array("name" => "registry.css"));
$tpl->assign("Title", "Registrierung");
?>