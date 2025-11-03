<?php

require_once(dirname(__FILE__) . "/../../class/module.class.php");


try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_POST) { 
    try {
        $module = new Module($db, $_POST);
        $module->create();

        header("Location: ../TD3/index.php?element=modules&action=list&success=1");
        exit; 

    } catch (Exception $e) {
        $message = "<div class='w3-panel w3-red'>
                        <p><strong>❌ Erreur :</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                    </div>";
    }
}
