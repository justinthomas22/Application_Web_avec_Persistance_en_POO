<div class="dtitle w3-container w3-teal">
Fiche matières
</div>
<div class="col-2">
</div>

<div class="col-2">
    <h2>Résultat</h2>

    <form class="w3-container" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">

                <input type="hidden" name="id" value="<?= htmlspecialchars($matiereData['matid'] ?? '') ?>">

                <div class="w3-half">
                    <label class="w3-text-blue" for="field3"><b><br>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="matnom" name="matnom" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($matiereData['matnom'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field4"><b><br>Coefficient</b></label>
                    <input class="w3-input w3-border" type="text" id="matcoeff" name="matcoeff" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($matiereData['matcoeff'] ?? '') ?>" />
                </div>

                <label class="w3-text-blue"><b><br>Module</b></label>
                <select class="w3-input w3-border" name="fk_modules">
                    <option value="">-- Choisir --</option>
                    <?php foreach ($fk_modules as $fk_module): ?>
                        <option value="<?= $fk_module['modid'] ?>"
                            <?= ($matiereData['fk_modules'] ?? '') == $fk_module['modid'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($fk_module['modnom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>


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