    <div class="dtitle w3-container w3-teal">
    Liste des enseignants
    </div>
    <div class="col-2">
    </div>

<button class="w3-btn filtrer-btn" id="openFilterBtn">Filtrer</button>

<div id="filterPanel" class="filter-panel">
    <button id="closeFilterBtn" class="close-btn">&times;</button>
    <h3>Filtres</h3>

    <form method="get" action="../TD3/index.php">
        <input type="hidden" name="element" value="enseignants">
        <input type="hidden" name="action" value="list">

        <label class="w3-text-blue"><b><br>Nom</b></label>
        <input class="w3-input w3-border" type="text" name="lastname" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['lastname'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Prénom</b></label>
        <input class="w3-input w3-border" type="text" name="firstname" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['firstname'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Date de naisance</b></label>
        <input class="w3-input w3-border" type="date" name="birthday" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['birthday'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Adresse</b></label>
        <input class="w3-input w3-border" type="text" name="adress" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['adress'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Code postale</b></label>
        <input class="w3-input w3-border" type="text" name="zipcode" placeholder="Chiffre à saisir"
            value="<?= htmlspecialchars($_GET['zipcode'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Ville</b></label>
        <input class="w3-input w3-border" type="text" name="town" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['town'] ?? '') ?>" />

        <button type="submit" class="w3-btn w3-blue w3-margin-top">Appliquer le filtre</button>
        <a href="index.php?element=enseignants&action=list" class="w3-btn w3-gray w3-margin-top">Réinitialiser</a>
    </form>

</div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="w3-panel w3-green">
            <p><strong>✅ L'enseignant a bien été créé avec succès !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ L'enseignant a bien été modifié !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ L'enseignant a bien été supprimé !</strong></p>
        </div>
    <?php endif; ?>


    <h1>Liste des enseignants</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Code postale</th>
                <th>Ville</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enseignants as $ens): ?>
                <tr>
                    <td><?= htmlspecialchars($ens['rowid']) ?></td>
                    <td>
                    <a href="../TD3/index.php?element=enseignants&action=card&id=<?= urlencode($ens['rowid']) ?>"> 
                        <?= htmlspecialchars($ens['lastname']) ?>
                    </a>
                    </td>
                    <td><?= htmlspecialchars($ens['firstname']) ?></td>
                    <td><?= htmlspecialchars($ens['birthday']) ?></td>
                    <td><?= htmlspecialchars($ens['adress']) ?></td>
                    <td><?= htmlspecialchars($ens['zipcode']) ?></td>
                    <td><?= htmlspecialchars($ens['town']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
  const openBtn = document.getElementById('openFilterBtn');
  const closeBtn = document.getElementById('closeFilterBtn');
  const filterPanel = document.getElementById('filterPanel');

  openBtn.addEventListener('click', () => {
    filterPanel.classList.add('open');
  });

  closeBtn.addEventListener('click', () => {
    filterPanel.classList.remove('open');
  });
</script>

