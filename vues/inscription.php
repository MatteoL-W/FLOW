<?php 

if (isset($_COOKIE['remember']) && !empty($_COOKIE['remember'])) {
    $sql = "SELECT * FROM user WHERE remember = ?";
    $query = $pdo->prepare($sql);
    $query -> execute(array($_COOKIE['remember']));
    $line = $query -> fetch();

    if ($line == true) {
        $_SESSION["info"]= "Vous vous êtes connecté.";
        $_SESSION['avatar'] = $line['avatar'];
        $_SESSION['id'] = $line['id'];
        $_SESSION['pseudo'] = $line['login'];
        header('Location: index.php?action=accueil');
    }
}

?>

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
                <input type="date" id='date' name="date_naissance" placeholder="Votre date de naissances" min="1930-01-01" max="2010-12-31" required>

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