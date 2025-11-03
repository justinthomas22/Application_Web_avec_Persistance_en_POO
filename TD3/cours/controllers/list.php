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

$enseignantMap = [];
foreach ($fk_enseignants as $ens) {
    $enseignantMap[$ens['rowid']] = $ens['lastname'] . ' ' . $ens['firstname'];
}

$matiereMap = [];
foreach ($fk_matieres as $mat) {
    $matiereMap[$mat['matid']] = $mat['matnom'];
}

$enseignants = array_values($enseignantMap);
$matieres = array_values($matiereMap);


$courObj = new Cour($db);

if (!empty($_GET)) {

    if (!empty($_GET['ens'])) {
        foreach ($enseignantMap as $id => $nom) {
            if (strtolower(trim($nom)) === strtolower(trim($_GET['ens']))) {
                $_GET['fk_enseignant'] = $id;
                break;
            }
        }
    }

    if (!empty($_GET['mat'])) {
        foreach ($matiereMap as $id => $nom) {
            if (strtolower(trim($nom)) === strtolower(trim($_GET['mat']))) {
                $_GET['fk_matiere'] = $id;
                break;
            }
        }
    }

    $cours = $courObj->find($_GET);
} else {
    $cours = $courObj->fetchAll();
}
