<div class="dtitle w3-container w3-teal">
Création d'un nouvel étudiant
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
                    <label class="w3-text-blue" for="field1"><b><br>Numéro étudiant</b></label>
                    <input class="w3-input w3-border" type="text" id="numetu" name="numetu" placeholder="Nombre à saisir"
                        value="<?php echo isset($_POST['numetu']) ? htmlspecialchars($_POST['numetu']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field2"><b><br>Prénom</b></label>
                    <input class="w3-input w3-border" type="text" id="firstname" name="firstname" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field3"><b><br>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="lastname" name="lastname" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field4"><b><br>Date de naissance</b></label>
                    <input class="w3-input w3-border" type="date" id="birthday" name="birthday"
                        value="<?php echo isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field5"><b><br>Diplome</b></label>
                    <select name="diploma" id="pet-select">
                        <option value="">--Choisir--</option>
                        <?php foreach ($diplomes as $diplome): ?>
                            <option value="<?php echo strtolower($diplome); ?>"><?php echo $diplome; ?></option>
                        <?php endforeach; ?>
                    </select>
                     
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field1"><b><br>Année</b></label>
                    <input class="w3-input w3-border" type="text" id="year" name="year" placeholder="Chiffre à saisir"
                        value="<?php echo isset($_POST['year']) ? htmlspecialchars($_POST['year']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field7"><b><br>Td</b></label>
                    <input class="w3-input w3-border" type="text" id="td" name="td" placeholder="Chiffre à saisir"
                        value="<?php echo isset($_POST['td']) ? htmlspecialchars($_POST['td']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field8"><b><br>Tp</b></label>
                    <input class="w3-input w3-border" type="text" id="tp" name="tp" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['tp']) ? htmlspecialchars($_POST['tp']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field9"><b><br>Adresse</b></label>
                    <input class="w3-input w3-border" type="text" id="adress" name="adress" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field10"><b><br>Code Postale</b></label>
                    <input class="w3-input w3-border" type="text" id="zipcode" name="zipcode" placeholder="Chiffre à saisir"
                        value="<?php echo isset($_POST['zipcode']) ? htmlspecialchars($_POST['zipcode']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field11"><b><br>Ville</b></label>
                    <input class="w3-input w3-border" type="text" id="town" name="town" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['town']) ? htmlspecialchars($_POST['town']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field12"><b><br>Username</b></label>
                    <input class="w3-input w3-border" type="text" id="username" name="username" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field13"><b><br>Mot de passe</b></label>
                    <input class="w3-input w3-border" type="text" id="password" name="password" placeholder="Texte à saisir"
                        value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" />
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