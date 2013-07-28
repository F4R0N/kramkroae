<pre>
<?php //print_r($_POST); ?>
</pre>
<?php
    include_once 'classes/registry.class.php';
    
    $registry = new registry();

    if(isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1){
        //echo "<h1>Check All wird nicht angezeigt</h1>";
        if($registry->checkAll()){
           //echo "<h1>Alles wird angezeigt</h1>";
           $registry->register();
           //echo "<h1>Registriert oder Fehler in registry.class!</h1>";
        }
    }
    //echo "<h1>Start</h1>";
    $tpl->addMainTemplate("registry.tpl.php");
    $tpl->addCss(array("name" => "registry.css"));
    $tpl->assign("Title", "Registrierung");
?>
