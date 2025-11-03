<?php

require_once(dirname(__FILE__) . "/../../class/matiere.class.php");
require_once(dirname(__FILE__) . "/../../class/module.class.php");

try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$moduleObj = new Module($db);
$fk_modules = $moduleObj->fetchAll(); 

$moduleMap = [];
foreach ($fk_modules as $mod) {
    $moduleMap[$mod['modid']] = $mod['modnom'];
}

$matiereObj = new Matiere($db);

if (!empty($_GET)) {
    if (!empty($_GET['mod'])) {
        foreach ($moduleMap as $id => $nom) {
            if (strtolower(trim($nom)) === strtolower(trim($_GET['mod']))) {
                $_GET['fk_modules'] = $id;
                break;
            }
        }
    }
    $matiere = $matiereObj->find($_GET);
} else {
    $matiere = $matiereObj->fetchAll();
}