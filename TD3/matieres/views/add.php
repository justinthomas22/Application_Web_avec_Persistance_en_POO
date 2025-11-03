<div class="dtitle w3-container w3-teal">
Création d'une nouvelle matière
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
                    <label class="w3-text-blue" for="field2"><b><br>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="matnom" name="matnom" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['matnom']) ? htmlspecialchars($_POST['matnom']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field10"><b><br>Coefficient</b></label>
                    <input class="w3-input w3-border" type="text" id="matcoeff" name="matcoeff" placeholder="Chiffre à saisir"
                        value="<?php echo isset($_POST['matcoeff']) ? htmlspecialchars($_POST['matcoeff']) : ''; ?>" />
                </div>

                <label class="w3-text-blue"><b><br>Module</b></label>
                <select class="w3-input w3-border" name="fk_modules">
                    <option value="">-- Choisir --</option>
                    <?php foreach ($fk_modules as $fk_module): ?>
                        <option value="<?= $fk_module['modid'] ?>"
                            <?= (isset($_POST['fk_modules']) && $_POST['fk_modules'] == $fk_module['modid']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($fk_module['modnom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <br><br>

                <div class="w3-half">
                    <p><br></p>
                    <input class="w3-btn w3-blue-grey" type="submit" id="boutton" value="Envoyer" name="Envoyer" />
                    <p><br></p>
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