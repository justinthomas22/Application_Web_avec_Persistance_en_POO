<div class="dtitle w3-container w3-teal">
Création d'un nouveau module
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
                    <input class="w3-input w3-border" type="text" id="modnom" name="modnom" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['modnom']) ? htmlspecialchars($_POST['modnom']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field10"><b><br>Coefficient</b></label>
                    <input class="w3-input w3-border" type="text" id="modcoeff" name="modcoeff" placeholder="Chiffre à saisir"
                        value="<?php echo isset($_POST['modcoeff']) ? htmlspecialchars($_POST['modcoeff']) : ''; ?>" />
                </div>

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