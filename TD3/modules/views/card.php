<div class="dtitle w3-container w3-teal">
Fiche modules
</div>
<div class="col-2">
</div>

<div class="col-2">
    <h2>Résultat</h2>

    <form class="w3-container" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">

                <input type="hidden" name="id" value="<?= htmlspecialchars($moduleData['modid'] ?? '') ?>">

                <div class="w3-half">
                    <label class="w3-text-blue" for="field3"><b><br>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="modnom" name="modnom" placeholder="Texte à saisir"
                        value="<?= htmlspecialchars($moduleData['modnom'] ?? '') ?>" />
                </div>

                <div class="w3-half">
                    <label class="w3-text-blue" for="field4"><b><br>Coefficient</b></label>
                    <input class="w3-input w3-border" type="text" id="modcoeff" name="modcoeff" placeholder="Chiffre à saisir"
                        value="<?= htmlspecialchars($moduleData['modcoeff'] ?? '') ?>" />
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