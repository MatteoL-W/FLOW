<?php

include("config/config.php");
include("config/bd.php"); // commentaire
include("config/actions.php");
session_start();
ob_start(); // Je démarre le buffer de sortie : les données à afficher sont stockées


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLOW - Creative Network</title>

    <link href="css/normalize.css" rel="stylesheet">
    <link href="fonts/font.css" rel="stylesheet">
    <link href="css/lightbox.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="favicon.png" />
</head>

<body>
    <?php

    if (isset($_SESSION['erreur'])) {
        echo "
        <div id='erreur'>
            <h3>Attention !</h3>
            <p>Une erreur est survenue:<br>
            " . $_SESSION['erreur'] . "</p>
            <img src='ressources/cross-sign.svg' alt='croix' id='croix_erreur'>
        </div>
        ";
        unset($_SESSION['erreur']);
    }

    if (isset($_SESSION['info'])) {
        echo "
            <div id='info'>
                <h3>Information</h3>
                <p>" . $_SESSION['info'] . "</p>
                <img src='ressources/cross-sign.svg' alt='croix' id='croix_info'>
            </div>
        ";
        unset($_SESSION['info']);
    }
    
    if (isset($_GET["action"])) {
        $action = $_GET["action"];       
    } else {
        if (isset($_SESSION['id'])){ // si jsuis co
            $action = "profil";
        } else {
            $action = "connexion";
        } 
    }


    // Est ce que cette action existe dans la liste des actions
    if (array_key_exists($action, $listeDesActions) == false) {
        include("vues/404.php"); // NON : page 404
    } else {
        include($listeDesActions[$action]); // Oui, on la charge
    }

    ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
    ?>

    <div id="displayLikes" style='display:none;'>
        <h2>Likes:</h2>
        <div class="all-likes" id="all-likes">
        </div>
        <img src='ressources/cross-sign-white.svg' alt='croix' id='croix_likes'>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>