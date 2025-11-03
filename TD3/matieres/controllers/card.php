<?php

require_once(dirname(__FILE__) . "/../../class/matiere.class.php");

try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$matiereData = [
    'matnom' => '',
    'matcoeff' => '',
];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $matiere = new Matiere($db);
    $data = $matiere->fetch($id);        
    $fk_modules = $matiere->fetchModulesList();

    if ($data) {
        $matiereData = $data;
    }

}

if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Modifier') {
    $id = intval($_GET['id']);
    $matiere = new Matiere($db, $_POST); 
    $matiere->matid = $id;

    $matiere->update();

    
    header("Location: ../TD3/index.php?element=matieres&action=list&updated=1");
    exit;
    
    $matiereData = $matiere->fetch($id); 
}


if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Supprimer') {
    $id = intval($_GET['id']);
    $matiere = new Matiere($db);
    $matiere->matid = $id; 

    $data = $matiere->fetch($id);

    $matiere->delete();
    header("Location: ../TD3/index.php?element=matieres&action=list&deleted=1");


    exit;
}

include '../views/card.php';

?>

<script>
function confirmerAction(action) {
    if (action === 'Supprimer') {
        return confirm("⚠️ Êtes-vous sûr de vouloir supprimer cette matière ? Aucun retour ne sera possible !");
    } else if (action === 'Modifier') {
        return confirm("Voulez-vous vraiment modifier les informations de cette matière ?");
    }
    return true;
}
</script>
