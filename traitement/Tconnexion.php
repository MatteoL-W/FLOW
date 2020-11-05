<?php

/*
$sql = "SELECT * FROM user WHERE login=? AND mdp=PASSWORD(?)";

// Etape 1  : preparation
$q = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute(array($_POST['login'], $_POST['pwd']));

// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.
$line = $q -> fetch();
// un seul fetch

// Si $line est faux le couple login mdp est mauvais, on retourne au formulaire
if ($line == false) {
    header("Location: index.php?action=login");
} else {
    $_SESSION['id'] = $line['id'];
    $_SESSION['login'] = $line['login'];
    header("Location: index.php");
}
// sinon on crée les variables de session $_SESSION['id'] et $_SESSION['login'] et on va à la page d'accueil
*/

$login = $_POST['login'];
$password = $_POST['mdp'];

if(isset($_POST['valider'], $login, $password)) {

    // BUG EMAIL
    $sql = "SELECT * FROM user WHERE (login=? AND mdp=PASSWORD(?)) OR (email=? AND mdp=PASSWORD(?))";
    $query = $pdo->prepare($sql);
    $query->execute(array($login, $password, $email, $password));
    $line = $query->fetch();

    if ($line == false) {
        $_SESSION['erreur']="L'authentification a échoué.";
        header('Location: index.php?action=connexion');  
    }
    else{   
        $_SESSION["info"]= "Vous vous êtes connecté.";
        $_SESSION['id'] = $line['id'];
        $_SESSION['pseudo'] = $line['login'];
        header('Location: index.php?action=profil');
    }
        

}
    
?>