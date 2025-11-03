<?php

require_once(dirname(__FILE__) . "/../../class/cour.class.php");


try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$cour = new Cour($db);          
$fk_enseignants = $cour->fetchEnseignantList();
$fk_matieres = $cour->fetchMatiereList();

if ($_POST) { 
    try {
        $cour = new Cour($db, $_POST);
        $cour->create();

        header("Location: ../TD3/index.php?element=cours&action=list&success=1");
        exit; 

    } catch (Exception $e) {
        $message = "<div class='w3-panel w3-red'>
                        <p><strong>❌ Erreur :</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                    </div>";
    }
}