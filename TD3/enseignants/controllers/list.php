<?php

require_once(dirname(__FILE__) . "/../../class/enseignant.class.php");


try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$enseignantObj = new Enseignant($db);

if (!empty($_GET)) {
    $enseignants = $enseignantObj->find($_GET);
} else {
    $enseignants = $enseignantObj->fetchAll();
}
