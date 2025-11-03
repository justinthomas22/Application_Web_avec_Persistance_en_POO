    <div class="dtitle w3-container w3-teal">
    Liste des étudiants
    </div>
    <div class="col-2">
    </div>

<button class="w3-btn filtrer-btn" id="openFilterBtn">Filtrer</button>

<div id="filterPanel" class="filter-panel">
    <button id="closeFilterBtn" class="close-btn">&times;</button>
    <h3>Filtres</h3>

    <form method="get" action="../TD3/index.php">
        <input type="hidden" name="element" value="etudiants">
        <input type="hidden" name="action" value="list">

        <label class="w3-text-blue"><b><br>Numéro étudiant</b></label>
        <input class="w3-input w3-border" type="text" name="numetu" placeholder="Numéro à saisir"
            value="<?= htmlspecialchars($_GET['numetu'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Nom</b></label>
        <input class="w3-input w3-border" type="text" name="lastname" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['lastname'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Prénom</b></label>
        <input class="w3-input w3-border" type="text" name="firstname" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['firstname'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Diplôme</b></label>
        <select class="w3-input w3-border" name="diploma">
            <option value="">-- Choisir --</option>
            <?php foreach ($diplomes as $diplome): ?>
                <option value="<?= strtolower($diplome) ?>"
                    <?= (isset($_GET['diploma']) && strtolower($_GET['diploma']) === strtolower($diplome)) ? 'selected' : '' ?>>
                    <?= $diplome ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label class="w3-text-blue"><b><br>Année</b></label>
        <input class="w3-input w3-border" type="text" name="year" placeholder="Chiffre à saisir"
            value="<?= htmlspecialchars($_GET['year'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>TD</b></label>
        <input class="w3-input w3-border" type="text" name="td" placeholder="Chiffre à saisir"
            value="<?= htmlspecialchars($_GET['td'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>TP</b></label>
        <input class="w3-input w3-border" type="text" name="tp" placeholder="Lettre à saisir"
            value="<?= htmlspecialchars($_GET['tp'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Ville</b></label>
        <input class="w3-input w3-border" type="text" name="town" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['town'] ?? '') ?>" />

        <button type="submit" class="w3-btn w3-blue w3-margin-top">Appliquer le filtre</button>
        <a href="index.php?element=etudiants&action=list" class="w3-btn w3-gray w3-margin-top">Réinitialiser</a>
    </form>

</div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="w3-panel w3-green">
            <p><strong>✅ L'étudiant a bien été créé avec succès !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ L'étudiant a bien été modifié !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ L'étudiant a bien été supprimé !</strong></p>
        </div>
    <?php endif; ?>


    <h1>Liste des étudiants</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Numéro étudiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Diplôme</th>
                <th>Année</th>
                <th>TD</th>
                <th>TP</th>
                <th>Ville</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etu): ?>
                <tr>
                    <td><?= htmlspecialchars($etu['rowid']) ?></td>
                    <td>
                    <a href="../TD3/index.php?element=etudiants&action=card&id=<?= urlencode($etu['rowid']) ?>">
                        <?= htmlspecialchars($etu['numetu']) ?>  
                    </a>
                    </td>
                    <td><?= htmlspecialchars($etu['lastname']) ?></td>
                    <td><?= htmlspecialchars($etu['firstname']) ?></td>
                    <td><?= htmlspecialchars($etu['diploma']) ?></td>
                    <td><?= htmlspecialchars($etu['year']) ?></td>
                    <td><?= htmlspecialchars($etu['td']) ?></td>
                    <td><?= htmlspecialchars($etu['tp']) ?></td>
                    <td><?= htmlspecialchars($etu['town']) ?></td>
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

