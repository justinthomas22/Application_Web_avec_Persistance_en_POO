<?php

require_once(dirname(__FILE__) . "/../../class/module.class.php");

try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$moduleData = [
    'modnom' => '',
    'modcoeff' => '',
];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $module = new Module($db);
    $data = $module->fetch($id);

    if ($data) {
        $moduleData = $data;
    }

}

if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Modifier') {
    $id = intval($_GET['id']);
    $module = new Module($db, $_POST); 
    $module->modid = $id;

    $module->update();

    header("Location: ../TD3/index.php?element=modules&action=list&updated=1");
    exit;
    
    $moduleData = $module->fetch($id); 
}


if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Supprimer') {
    $id = intval($_GET['id']);
    $module = new Module($db);
    $module->modid = $id; 

    $data = $module->fetch($id);

    $module->delete();
    header("Location: ../TD3/index.php?element=modules&action=list&deleted=1");


    exit;
}

include '../views/card.php';

?>

<script>
function confirmerAction(action) {
    if (action === 'Supprimer') {
        return confirm("⚠️ Êtes-vous sûr de vouloir supprimer ce module ? Aucun retour ne sera possible !");
    } else if (action === 'Modifier') {
        return confirm("Voulez-vous vraiment modifier les informations de ce module ?");
    }
    return true;
}
</script>
