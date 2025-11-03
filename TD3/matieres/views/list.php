    <div class="dtitle w3-container w3-teal">
    Liste des matières
    </div>
    <div class="col-2">
    </div>

<button class="w3-btn filtrer-btn" id="openFilterBtn">Filtrer</button>

<div id="filterPanel" class="filter-panel">
    <button id="closeFilterBtn" class="close-btn">&times;</button>
    <h3>Filtres</h3>

    <form method="get" action="../TD3/index.php">
        <input type="hidden" name="element" value="matieres">
        <input type="hidden" name="action" value="list">

        <label class="w3-text-blue"><b><br>Nom</b></label>
        <input class="w3-input w3-border" type="text" name="matnom" placeholder="Texte à saisir"
            value="<?= htmlspecialchars($_GET['matnom'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Coefficient</b></label>
        <input class="w3-input w3-border" type="text" name="matcoeff" placeholder="Chiffre à saisir"
            value="<?= htmlspecialchars($_GET['matcoeff'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Module</b></label>
        <select class="w3-input w3-border" name="mod">
            <option value="">-- Choisir --</option>
            <?php foreach ($fk_modules as $module): ?>
                <option value="<?= htmlspecialchars($module['modnom']) ?>"
                    <?= (isset($_GET['mod']) && $_GET['mod'] == $module['modnom']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($module['modnom']) ?>
                </option>
            <?php endforeach; ?>
        </select>




        <button type="submit" class="w3-btn w3-blue w3-margin-top">Appliquer le filtre</button>
        <a href="index.php?element=matieres&action=list" class="w3-btn w3-gray w3-margin-top">Réinitialiser</a>
    </form>

</div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="w3-panel w3-green">
            <p><strong>✅ La matière a bien été créé avec succès !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ Le matière a bien été modifié !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ La matière a bien été supprimée !</strong></p>
        </div>
    <?php endif; ?>


    <h1>Liste des matières</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Coefficient</th>
                <th>Module</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matiere as $mat): ?>
                <tr>
                    <td><?= htmlspecialchars($mat['matid']) ?></td>
                    <td>
                    <a href="../TD3/index.php?element=matieres&action=card&id=<?= urlencode($mat['matid']) ?>"> 
                        <?= htmlspecialchars($mat['matnom']) ?>
                    </a>
                    </td>
                    <td><?= htmlspecialchars($mat['matcoeff']) ?></td>
                    <td>
                        <?= htmlspecialchars($moduleMap[$mat['fk_modules']]) ?>
                    </td>

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

