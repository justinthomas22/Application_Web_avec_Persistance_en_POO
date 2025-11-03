<div class="dtitle w3-container w3-teal">
Fiche enseignant
</div>
<div class="col-2">
</div>

<div class="col-2">
    <h2>Résultat</h2>

    <form class="w3-container" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">

                <input type="hidden" name="id" value="<?= htmlspecialchars($enseignantData['rowid'] ?? '') ?>">

                <div class="w3-half">
                    <label class="w3-text-blue" for="field2"><b><br>Prénom</b></label>
                    <input class="w3-input w3-border" type="text" id="firstname" name="firstname" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($enseignantData['firstname'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field3"><b><br>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="lastname" name="lastname" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($enseignantData['lastname'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field4"><b><br>Date de naissance</b></label>
                    <input class="w3-input w3-border" type="date" id="birthday" name="birthday"
                        value="<?= htmlspecialchars($enseignantData['birthday'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field9"><b><br>Adresse</b></label>
                    <input class="w3-input w3-border" type="text" id="adress" name="adress" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($enseignantData['adress'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field10"><b><br>Code Postale</b></label>
                    <input class="w3-input w3-border" type="text" id="zipcode" name="zipcode" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($enseignantData['zipcode'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field11"><b><br>Ville</b></label>
                    <input class="w3-input w3-border" type="text" id="town" name="town" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($enseignantData['town'] ?? '') ?>" />
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
