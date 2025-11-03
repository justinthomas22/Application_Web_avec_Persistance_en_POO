<div class="dtitle w3-container w3-teal">
Création d'un nouveau cours
</div>
<div class="col-2">
</div>

<div class="col-2">
    <h2>Résultat</h2>

    <?php if (!empty($message)) echo $message; ?>


    <form class="w3-container" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="dates"><b><br>Date du cours</b></label>
                    <input class="w3-input w3-border" type="date" id="dates" name="dates"
                        value="<?php echo isset($_POST['dates']) ? htmlspecialchars($_POST['dates']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="heure_deb"><b><br>Heure de début</b></label>
                    <input class="w3-input w3-border" type="text" id="heure_deb" name="heure_deb" placeholder="Format HH:MM:SS"
                        value="<?php echo isset($_POST['heure_deb']) ? htmlspecialchars($_POST['heure_deb']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="heure_fin"><b><br>Heure de fin</b></label>
                    <input class="w3-input w3-border" type="text" id="heure_fin" name="heure_fin" placeholder="Format HH:MM:SS"
                        value="<?php echo isset($_POST['heure_fin']) ? htmlspecialchars($_POST['heure_fin']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="promo"><b><br>Promo</b></label>
                    <input class="w3-input w3-border" type="text" id="promo" name="promo" placeholder="Chiffre à saisir"
                        value="<?php echo isset($_POST['promo']) ? htmlspecialchars($_POST['promo']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="cour_td"><b><br>Td</b></label>
                    <input class="w3-input w3-border" type="text" id="cour_td" name="cour_td" placeholder="Si cours en Promo ne pas saisir"
                        value="<?php echo isset($_POST['cour_td']) ? htmlspecialchars($_POST['cour_td']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="cour_tp"><b><br>Tp</b></label>
                    <input class="w3-input w3-border" type="text" id="cour_tp" name="cour_tp" placeholder="Si cours en TD ne pas saisir"
                        value="<?php echo isset($_POST['cour_tp']) ? htmlspecialchars($_POST['cour_tp']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Enseignant</b></label>
                    <select class="w3-input w3-border" name="fk_enseignant">
                        <option value="">-- Choisir --</option>
                        <?php foreach ($fk_enseignants as $fk_enseignant): ?>
                            <option value="<?= $fk_enseignant['rowid'] ?>"
                                <?= (isset($_POST['fk_enseignant']) && $_POST['fk_enseignant'] == $fk_enseignant['rowid']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($fk_enseignant['lastname'] . ' ' . $fk_enseignant['firstname']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue"><b><br>Matière</b></label>
                    <select class="w3-input w3-border" name="fk_matiere">
                        <option value="">-- Choisir --</option>
                        <?php foreach ($fk_matieres as $fk_matiere): ?>
                            <option value="<?= $fk_matiere['matid'] ?>"
                                <?= (isset($_POST['fk_matiere']) && $_POST['fk_matiere'] == $fk_matiere['matid']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($fk_matiere['matnom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <br><br>

                <div class="w3-half">
                    <p><br></p>
                    <input class="w3-btn w3-blue-grey" type="submit" id="boutton" value="Envoyer" name="Envoyer" />
                </div>

                <div class="w3-half">
                    <p><br></p>
                    <input class="w3-btn w3-red" type="reset" value="Réinitialiser" />
                    <p><br></p>
                </div>
            </div>
        </div>
    </form>
</div>
