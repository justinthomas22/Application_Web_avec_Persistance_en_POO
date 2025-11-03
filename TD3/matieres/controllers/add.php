<?php

require_once(dirname(__FILE__) . "/../../class/matiere.class.php");


try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_POST) { 
    try {
        $matiere = new Matiere($db, $_POST);
        $matiere->create();

        header("Location: ../TD3/index.php?element=matieres&action=list&success=1");
        exit; 

    } catch (Exception $e) {
        $message = "<div class='w3-panel w3-red'>
                        <p><strong>❌ Erreur :</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                    </div>";
    }
}

$matiere = new Matiere($db);          
$fk_modules = $matiere->fetchModulesList();