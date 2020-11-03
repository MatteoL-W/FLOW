<section id="profil" class="split-menu">
    <?php include("divers/header.php"); ?>

    <div id="screen">
        <div class="profil-banner">
            <img src="ressources/edit.png" alt="Editer la bannière">
        </div>

        <div class="profil-avatar">
            <img src="ressources/edit.png" alt="Editer la bannière">
        </div>

        <form class="monCompte" method="post">
            <input name="pseudo" type="text" value="Josman" class="big-input"> 
            <input name="age" type="text" value="22 ans" class="big-input"><br>
            <input name="pseudo" type="text" value="Rappeur, Compositeur, Producteur" class="italic-input"><br>
            <textarea name="biographie" placeholder="Ma biographie" rows="4"></textarea><br>
            
            <div>
                <label for="soundcloud">Soundcloud:</label>
                <input type="text" name="soundcloud" value="https://soundcloud.com/josman" class="lien"><br>
            
                <label for="soundcloud">Youtube:</label>
                <input type="text" name="youtube"  class="lien"><br>

                <label for="soundcloud">Behance:</label>
                <input type="text" name="behance" class="lien"><br>

                <label for="soundcloud">Instagram:</label>
                <input type="text" name="instagram"  class="lien"><br>

                <label for="soundcloud">Twitter:</label>
                <input type="text" name="twitter"  class="lien"><br>

                <label for="soundcloud">Facebook:</label>
                <input type="text" name="facebook" class="lien"><br>

                <label for="soundcloud">Pinterest:</label>
                <input type="text" name="pinterest" class="lien"><br>
            </div>

            <input type="submit" class="btn-default" value="Effectuer les modifications">
        </form>

        <div class="changerInfos">
            <span class="btn-default">Changer de mot de passe</span>
            <span class="btn-default">Changer d'adresse mail</span>
        </div>
        

        
    </div>
</section>