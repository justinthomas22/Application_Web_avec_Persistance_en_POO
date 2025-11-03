<?php

require_once(dirname(__FILE__) . "/../../class/etudiant.class.php");


try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$etudiant = new Etudiant($db);

if (!empty($_GET)) {
    $etudiants = $etudiant->find($_GET);
} else {
    $etudiants = $etudiant->fetchAll();
}

$diplomes = $etudiant->getListeDiplome();
