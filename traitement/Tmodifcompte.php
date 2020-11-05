<?php

if (isset($_POST['valider'])) {
    include('divers/upload.php');
    if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])) {
        uploadImage("avatar");
    }
    
    if (isset($_FILES['banniere']['name']) && !empty($_FILES['banniere']['name'])) {
        uploadImage("banniere");
    }
    
    //$sql1 = "INSERT INTO user(login,email,avatar,date_naissance,banniere,interets,biographie) values(?, ?, ?, ?, ?, ?, ?)";
    /*$sql1 = "UPDATE user
             SET login = ?,
             email = ?,
             avatar = ?,
             date_naissance = ?,
             banniere = ?,
             interets = ?,
             biographie = ? WHERE id = ?";
    $query1 = $pdo -> prepare($sql1);
    $query1 -> execute(array($_POST['pseudo'], $_POST['email'], $_FILES['avatar']['name'], $_POST['age'], $_FILES['banniere']['name'],$_POST['interets'],$_POST['biographie'],$_SESSION['id']));

    $_SESSION['info'] = 'Modification prise en compte';
    header('Location: index.php?action=monCompte');

    /*$sql2 = "INSERT INTO reseaux values(null, ?, PASSWORD(?), ?, 1, ?, ?, ?, '', '')";
    $query2 = $pdo -> prepare($sql2);
    $query2 -> execute(array($pseudo, $mdp1, $email, $avatar,$dn,'ressources/jokair-banner.png'));*/
    
}

?>