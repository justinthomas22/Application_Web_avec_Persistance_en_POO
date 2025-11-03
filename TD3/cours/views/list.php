    <div class="dtitle w3-container w3-teal">
    Liste des cours
    </div>
    <div class="col-2">
    </div>

<button class="w3-btn filtrer-btn" id="openFilterBtn">Filtrer</button>

<div id="filterPanel" class="filter-panel">
    <button id="closeFilterBtn" class="close-btn">&times;</button>
    <h3>Filtres</h3>

    <form method="get" action="../TD3/index.php">
        <input type="hidden" name="element" value="cours">
        <input type="hidden" name="action" value="list">

        <label class="w3-text-blue"><b><br>Date</b></label>
        <input class="w3-input w3-border" type="date" name="dates"
            value="<?= htmlspecialchars($_GET['dates'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Heure début</b></label>
        <input class="w3-input w3-border" type="text" name="heure_deb" placeholder="Format : HH:MM:SS"
            value="<?= htmlspecialchars($_GET['heure_deb'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Heure fin</b></label>
        <input class="w3-input w3-border" type="text" name="heure_fin" placeholder="Format : HH:MM:SS"
            value="<?= htmlspecialchars($_GET['heure_fin'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Promo</b></label>
        <input class="w3-input w3-border" type="text" name="promo" placeholder="Chiffre à saisir"
            value="<?= htmlspecialchars($_GET['promo'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>TD</b></label>
        <input class="w3-input w3-border" type="text" name="cour_td" placeholder="Chiffre à saisir"
            value="<?= htmlspecialchars($_GET['cour_td'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>TP</b></label>
        <input class="w3-input w3-border" type="text" name="cour_tp" placeholder="Lettre à saisir"
            value="<?= htmlspecialchars($_GET['cour_tp'] ?? '') ?>" />

        <label class="w3-text-blue"><b><br>Enseignant</b></label>
        <select class="w3-input w3-border" name="ens">
            <option value="">-- Choisir --</option>
            <?php foreach ($enseignants as $enseignant): ?>
                <option value="<?= strtolower($enseignant) ?>"
                    <?= (isset($_GET['ens']) && strtolower($_GET['ens']) === strtolower($enseignant)) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($enseignant) ?>
                </option>
            <?php endforeach; ?>
        </select>


        <label class="w3-text-blue"><b><br>Matiere</b></label>
        <select class="w3-input w3-border" name="mat">
            <option value="">-- Choisir --</option>
            <?php foreach ($matieres as $matiere): ?>
                <option value="<?= strtolower($matiere) ?>"
                    <?= (isset($_GET['mat']) && strtolower($_GET['mat']) === strtolower($matiere)) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($matiere) ?>
                </option>
            <?php endforeach; ?>
        </select>


        <button type="submit" class="w3-btn w3-blue w3-margin-top">Appliquer le filtre</button>
        <a href="index.php?element=cours&action=list" class="w3-btn w3-gray w3-margin-top">Réinitialiser</a>
    </form>

</div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="w3-panel w3-green">
            <p><strong>✅ Le cour a bien été créé avec succès !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ Le cour a bien été modifié !</strong></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="w3-panel w3-blue">
            <p><strong>✅ Le cour a bien été supprimé !</strong></p>
        </div>
    <?php endif; ?>


    <h1>Liste des cours</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Promo</th>
                <th>TD</th>
                <th>TP</th>
                <th>Enseignant</th>
                <th>Matière</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cours as $cour): ?>
                <tr>
                    <td><?= htmlspecialchars($cour['cour_id']) ?></td>
                    <td>
                    <a href="../TD3/index.php?element=cours&action=card&id=<?= urlencode($cour['cour_id']) ?>">
                        <?= htmlspecialchars($cour['dates']) ?>  
                    </a>
                    </td>
                    <td><?= htmlspecialchars($cour['heure_deb']) ?></td>
                    <td><?= htmlspecialchars($cour['heure_fin']) ?></td>
                    <td><?= htmlspecialchars($cour['promo']) ?></td>
                    <td><?= htmlspecialchars($cour['cour_td']) ?></td>
                    <td><?= htmlspecialchars($cour['cour_tp']) ?></td>
                    <td><?= htmlspecialchars($enseignantMap[$cour['fk_enseignant']] ?? '') ?></td>
                    <td><?= htmlspecialchars($matiereMap[$cour['fk_matiere']] ?? '') ?></td>


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

