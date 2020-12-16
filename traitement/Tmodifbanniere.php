<?php

if (isset($_POST['valider'])) {
    if (file_exists($_FILES['banniere']['name'])) {
        unlink('upload/'.$_FILES['banniere']['name']);
    }
    include('divers/upload.php');
    if (isset($_FILES['banniere']['name']) && !empty($_FILES['banniere']['name'])) {
        uploadImage("banniere");
        
        $sql1 = "UPDATE user SET banniere = ? WHERE id = ?";

        $query1 = $pdo -> prepare($sql1);
        $query1 -> execute(array($_FILES['banniere']['name'], $_SESSION['id']));

        if (!isset($_SESSION['erreur'])) {
            $_SESSION['info'] = 'Banniere modifiée.';
            header('Location: index.php?action=monCompte');
        }
        
        header('Location: index.php?action=monCompte');
        //$_FILES['avatar']['name']
        //$_FILES['banniere']['name']
        //$_SESSION['avatar'] = $_FILES['avatar']['name'];
    } else {
        $_SESSION['erreur'] = 'Les modifications de bannières n\'ont pas été prises en compte.';
        header('Location: index.php?action=monCompte');
    }
}
?>