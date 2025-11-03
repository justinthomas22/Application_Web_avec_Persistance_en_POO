<?php

require_once(dirname(__FILE__) . "/../../class/module.class.php");


try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$moduleObj = new Module($db);

if (!empty($_GET)) {
    $module = $moduleObj->find($_GET);
} else {
    $module = $moduleObj->fetchAll();
}
