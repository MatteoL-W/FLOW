<div id="inscription" class="split-index">
    <div class="partie-logo">
        <div>
            <img src="ressources/logo-flow.png" alt="logo flow">
        </div>
        
        <h2>The creative network</h2>
        <p>World first creative network</p>
    </div>

    <div class="partie-form">
        <h1>Inscription</h1>
        <div class="flex">
            <form action="index.php?action=Tinscription" method="post" enctype="multipart/form-data">
                <input type="email" name ='email' placeholder="Votre adresse email *" required>
                <input type="date" name="date_naissance" placeholder="Votre date de naissances" required>

                <div>
                    <input type="text" name ='pseudo' placeholder="Votre pseudo*" required>
                    <input type="password" name ='mdp1' placeholder="Mot de passe*" required>
                </div>
                
                <div class="seul">
                    <input type="password" name= 'mdp2' placeholder="Confirmer le mot de passe*" rquired>
                </div>

                
                <div class="checkBox">
                    <input type="checkbox" name="remember">
                    <label for="remember">Se souvenir de moi?</label>
                </div>
                
                <input name="avatar" type="file" accept="image/png, image/jpeg">

                <input type="submit" name='valider' value="M'inscrire" class="btn-default">
            </form>

            <div>
                <p><a href="index.php?action=connexion">Déjà inscrit ?<br>Connectez-vous maintenant !</a></p>
            </div>
        </div>
    </div>
</div>