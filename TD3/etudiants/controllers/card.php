<?php

require_once(dirname(__FILE__) . "/../../class/etudiant.class.php");

try {
    $db = new PDO('mysql:host=localhost;dbname=r301project;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$etudiantData = [
    'numetu' => '',
    'firstname' => '',
    'lastname' => '',
    'birthday' => '',
    'diploma' => '',
    'year' => '',
    'td' => '',
    'tp' => '',
    'adress' => '',
    'zipcode' => '',
    'town' => '',
    'username' => '',
    'password' => ''
];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $etudiant = new Etudiant($db);
    $data = $etudiant->fetch($id);

    $data_user = $etudiant->fetch_user($id);

    if ($data) {
        $etudiantData = $data;
    }

}

if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Modifier') {
    $id = intval($_GET['id']);
    $etudiant = new Etudiant($db);
    $etudiant->hydrate($_POST, true);
    $etudiant->rowid = $id; 

    $data = $etudiant->fetch($id);
    $etudiant->fk_user = $data['fk_user'] ?? null;

    $etudiant->update();

    header("Location: ../TD3/index.php?element=etudiants&action=list&updated=1");
    exit;

    $etudiantData = $etudiant->fetch($id);
}

if (isset($_POST['Envoyer']) && $_POST['Envoyer'] === 'Supprimer') {
    $id = intval($_GET['id']);
    $etudiant = new Etudiant($db);
    $etudiant->rowid = $id; 

    $data = $etudiant->fetch($id);
    $etudiant->fk_user = $data['fk_user'] ?? null;

    $etudiant->delete();
    header("Location: ../TD3/index.php?element=etudiants&action=list&deleted=1");
    exit;
}

$diplomes = $etudiant->getListeDiplome();


include '../views/card.php';

?>

<script>
function confirmerAction(action) {
    if (action === 'Supprimer') {
        return confirm("⚠️ Êtes-vous sûr de vouloir supprimer cet étudiant ? Aucun retour ne sera possible !");
    } else if (action === 'Modifier') {
        return confirm("Voulez-vous vraiment modifier les informations de cet étudiant ?");
    }
    return true;
}
</script>