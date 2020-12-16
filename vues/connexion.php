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

<div id="connexion" class="split-index">
    <div class="partie-logo">
        <div>
            <img src="ressources/logo-flow.png" alt="logo flow">
        </div>
        
        <h2>The creative network</h2>
        <p>World first creative network</p>
    </div>

    <div class="partie-form">
        <h1>Connexion</h1>
        <div class="flex">
            <form action="index.php?action=Tconnexion" method="post">
                <input type="text" name="login" placeholder="Email ou pseudo">
                <input type="password" name="mdp" placeholder="Mot de passe">
                <div class="checkBox">
                    <input type="checkbox" name="remember">
                    <label for="remember">Se souvenir de moi?</label>
                </div>
                <input type="submit" value="Se connecter" class="btn-default" name='valider'>
            </form>

            <div>
                <p>Pas encore inscrit ?<br>Inscrivez-vous maintenant !</p>
                <a href="index.php?action=inscription" class="btn-default">S'inscrire</a>
            </div>
        </div>
    </div>
</div>