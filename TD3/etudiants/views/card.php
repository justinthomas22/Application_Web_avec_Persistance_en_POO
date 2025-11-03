<div class="dtitle w3-container w3-teal">
Fiche étudiant
</div>
<div class="col-2">
</div>

<div class="col-2">
    <h2>Résultat</h2>

    <form class="w3-container" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">

                <input type="hidden" name="id" value="<?= htmlspecialchars($etudiantData['rowid'] ?? '') ?>">

                <div class="w3-half">
                    <label class="w3-text-blue" for="field1"><b><br>Numéro étudiant</b></label>
                    <input class="w3-input w3-border" type="text" id="numetu" name="numetu" placeholder="Nombre à saisir"
                        value="<?= htmlspecialchars($etudiantData['numetu'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field2"><b><br>Prénom</b></label>
                    <input class="w3-input w3-border" type="text" id="firstname" name="firstname" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($etudiantData['firstname'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field3"><b><br>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="lastname" name="lastname" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($etudiantData['lastname'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field4"><b><br>Date de naissance</b></label>
                    <input class="w3-input w3-border" type="date" id="birthday" name="birthday"
                        value="<?= htmlspecialchars($etudiantData['birthday'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field5"><b><br>Diplome</b></label>

                    <select name="diploma" id="pet-select">
                        <option value="">--Choisir--</option>
                        <?php foreach ($diplomes as $diplome):
                            $value = strtolower($diplome);
                            $selected = ($value === strtolower($etudiantData['diploma'] ?? '')) ? 'selected' : '';
                        ?>
                            <option value="<?= $value ?>" <?= $selected ?>><?= $diplome ?></option>
                        <?php endforeach; ?>
                    </select>
                     
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field1"><b><br>Année</b></label>
                    <input class="w3-input w3-border" type="text" id="year" name="year" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($etudiantData['year'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field7"><b><br>Td</b></label>
                    <input class="w3-input w3-border" type="text" id="td" name="td" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($etudiantData['td'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field8"><b><br>Tp</b></label>
                    <input class="w3-input w3-border" type="text" id="tp" name="tp" placeholder="Lettre à saisir"
                        value="<?= htmlspecialchars($etudiantData['tp'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field9"><b><br>Adresse</b></label>
                    <input class="w3-input w3-border" type="text" id="adress" name="adress" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($etudiantData['adress'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field10"><b><br>Code Postale</b></label>
                    <input class="w3-input w3-border" type="text" id="zipcode" name="zipcode" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($etudiantData['zipcode'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field11"><b><br>Ville</b></label>
                    <input class="w3-input w3-border" type="text" id="town" name="town" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($etudiantData['town'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field12"><b><br>Username</b></label>
                    <input class="w3-input w3-border" type="text" id="username" name="username" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($data_user['username'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field13"><b><br>Mot de passe</b></label>
                    <input class="w3-input w3-border" type="text" id="password" name="password" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($date_user['password'] ?? '') ?>" />
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