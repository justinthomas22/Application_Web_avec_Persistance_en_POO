<div class="dtitle w3-container w3-teal">
Fiche cours
</div>

<div class="col-2">
</div>

<div class="col-2">
    <h2>Résultat</h2>

    <form class="w3-container" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">

                <input type="hidden" name="cour_id" value="<?= htmlspecialchars($courData['cour_id']) ?>">

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Date</b></label>
                    <input class="w3-input w3-border" type="date" name="dates"
                        value="<?= htmlspecialchars($courData['dates']) ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Heure de début</b></label>
                    <input class="w3-input w3-border" type="text" name="heure_deb" placeholder="Format : HH:MM:SS"
                        value="<?= htmlspecialchars($courData['heure_deb']) ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Heure de fin</b></label>
                    <input class="w3-input w3-border" type="text" name="heure_fin" placeholder="Format : HH:MM:SS"
                        value="<?= htmlspecialchars($courData['heure_fin']) ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Promo</b></label>
                    <input class="w3-input w3-border" type="text" name="promo" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($courData['promo']) ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Td</b></label>
                    <input class="w3-input w3-border" type="text" name="cour_td" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($courData['cour_td']) ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Tp</b></label>
                    <input class="w3-input w3-border" type="text" name="cour_tp" placeholder="Lettre à saisir"
                        value="<?= htmlspecialchars($courData['cour_tp']) ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Enseignant</b></label>
                    <select class="w3-input w3-border" name="fk_enseignant">
                        <option value="">-- Choisir --</option>
                        <?php foreach ($enseignants as $id => $nom): 
                            $selected = ($courData['fk_enseignant'] == $id) ? 'selected' : '';
                        ?>
                            <option value="<?= $id ?>" <?= $selected ?>><?= htmlspecialchars($nom) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Matière</b></label>
                    <select class="w3-input w3-border" name="fk_matiere">
                        <option value="">-- Choisir --</option>
                        <?php foreach ($matieres as $id => $nom): 
                            $selected = ($courData['fk_matiere'] == $id) ? 'selected' : '';
                        ?>
                            <option value="<?= $id ?>" <?= $selected ?>><?= htmlspecialchars($nom) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <br><br>

                <div class="w3-half">
                    <p><br></p>
                    <input 
                        class="w3-btn w3-orange" 
                        type="submit" 
                        id="boutton" 
                        value="Modifier" 
                        name="Envoyer"
                        onclick="return confirmerAction('Modifier');"
                    />
                    <p><br></p>
                </div>

                <div class="w3-half">
                    <p><br></p>
                    <input 
                        class="w3-btn w3-red" 
                        type="submit" 
                        id="boutton" 
                        value="Supprimer" 
                        name="Envoyer"
                        onclick="return confirmerAction('Supprimer');"
                    />
                    <p><br></p>
                </div>
            </div>
        </div>
    </form>
</div>
