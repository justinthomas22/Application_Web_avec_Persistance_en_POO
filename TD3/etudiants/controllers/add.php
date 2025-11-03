<?php

require_once(dirname(__FILE__) . "/../../class/etudiant.class.php");


try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_POST) { 
    try {
        $etudiant = new Etudiant($db, $_POST);
        $etudiant->create();

        header("Location: ../TD3/index.php?element=etudiants&action=list&success=1");
        exit; 

    } catch (Exception $e) {
        $message = "<div class='w3-panel w3-red'>
                        <p><strong>❌ Erreur :</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                    </div>";
    }
}

$etudiant = new Etudiant($db);

$diplomes = $etudiant->getListeDiplome();
