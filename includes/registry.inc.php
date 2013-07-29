<pre>
<?php //print_r($_POST); ?>
</pre>
<?php
    if($_GET["mode"] == "user"){
        include_once 'classes/registry.class.php';
        $registry = new registry();
        echo "1";
        if(isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1){
            if(!$registry->checkIfErrors()){
               $registry->register();
               echo "<h1>Erfolgreich registriert!</h1>";
            }else{
                echo "<h1>Registrierung fehlgeschlagen!</h1>";
            }
        }
        $tpl->addMainTemplate("registry.tpl.php");
        $tpl->addCss(array("name" => "registry.css"));
        $tpl->assign("Title", "Registrierung");
    }
    elseif ($_GET["mode"] == "school") {
        include_once 'classes/schoolRegistry.class.php';
        $registry = new registry();
        if(isset($_POST["registerSubmit"]) && $_POST["registerSubmit"] == 1){
                if(!$registry->checkAll()){
                   $registry->register();
                   echo "<h1>Erfolgreich registriert!</h1>";
                }else{
                    echo "<h1>Registrierung fehlgeschlagen!</h1>";
                }
            }
            $tpl->addMainTemplate("registry.tpl.php");
            $tpl->addCss(array("name" => "registry.css"));
            $tpl->assign("Title", "Registrierung");
    }
?>
