<?php
require_once(dirname(__FILE__) . "/../../class/cour.class.php");

try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$courObj = new Cour($db);

$fk_enseignants = $courObj->fetchEnseignantList(); 
$fk_matieres = $courObj->fetchMatiereList();    

$enseignants = [];
foreach ($fk_enseignants as $ens) {
    $enseignants[$ens['rowid']] = $ens['lastname'] . ' ' . $ens['firstname'];
}

$matieres = [];
foreach ($fk_matieres as $mat) {
    $matieres[$mat['matid']] = $mat['matnom'];
}

$courData = [
    'cour_id' => '',
    'dates' => '',
    'heure_deb' => '',
    'heure_fin' => '',
    'promo' => '',
    'cour_td' => '',
    'cour_tp' => '',
    'fk_enseignant' => '',
    'fk_matiere' => '',
];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $data = $courObj->fetch($id);
    if ($data) {
        $courData = $data;
    }
}

if (isset($_POST['Envoyer'])) {
    $id = intval($_GET['id']);
    $cour = new Cour($db, $_POST);
    $cour->cour_id = $id;

    if ($_POST['Envoyer'] === 'Modifier') {
        $cour->update();
        header("Location: ../TD3/index.php?element=cours&action=list&updated=1");
        exit;
        $courData = $cour->fetch($id); 
    } elseif ($_POST['Envoyer'] === 'Supprimer') {
        $cour->delete();
        header("Location: ../TD3/index.php?element=cours&action=list&deleted=1");
        exit;
    }
}

include '../views/card.php';

?>

<script>
function confirmerAction(action) {
    if (action === 'Supprimer') {
        return confirm("⚠️ Êtes-vous sûr de vouloir supprimer ce cour ? Aucun retour ne sera possible !");
    } else if (action === 'Modifier') {
        return confirm("Voulez-vous vraiment modifier les informations de ce cour ?");
    }
    return true;
}
</script>