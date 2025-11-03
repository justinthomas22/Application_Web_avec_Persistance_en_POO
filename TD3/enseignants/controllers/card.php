<?php

require_once(dirname(__FILE__) . "/../../class/enseignant.class.php");

try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$etudiantData = [
    'firstname' => '',
    'lastname' => '',
    'birthday' => '',
    'adress' => '',
    'zipcode' => '',
    'town' => '',
    'username' => '',
    'password' => ''
];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $enseignant = new Enseignant($db);
    $data = $enseignant->fetch($id);

    $data_user = $enseignant->fetch_user($id);

    if ($data) {
        $enseignantData = $data;
    }

}

if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Modifier') {
    $id = intval($_GET['id']);
    $enseignant = new Enseignant($db);
    $enseignant->hydrate($_POST, true);
    $enseignant->rowid = $id; 

    $data = $enseignant->fetch($id);
    $enseignant->fk_user = $data['fk_user'] ?? null;

    $enseignant->update();

    header("Location: ../TD3/index.php?element=enseignants&action=list&updated=1");
    exit;

    $enseignantData = $enseignant->fetch($id);
}

if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Supprimer') {
    $id = intval($_GET['id']);
    $enseignant = new Enseignant($db);
    $enseignant->rowid = $id; 

    $data = $enseignant->fetch($id);
    $enseignant->fk_user = $data['fk_user'] ?? null;

    $enseignant->delete();
    header("Location: ../TD3/index.php?element=enseignants&action=list&deleted=1");

    exit;
}

include '../views/card.php';

?>

<script>
function confirmerAction(action) {
    if (action === 'Supprimer') {
        return confirm("⚠️ Êtes-vous sûr de vouloir supprimer cet enseignant ? Aucun retour ne sera possible !");
    } else if (action === 'Modifier') {
        return confirm("Voulez-vous vraiment modifier les informations de cet enseignant ?");
    }
    return true;
}
</script>
