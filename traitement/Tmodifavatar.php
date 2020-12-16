<?php

if (isset($_POST['valider'])) {
    if (file_exists($_FILES['avatar']['name'])) {
        unlink('upload/'.$_FILES['avatar']['name']);
    }
    include('divers/upload.php');
    if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])) {
        uploadImage("avatar");
        
        $sql1 = "UPDATE user SET avatar = ? WHERE id = ?";

        $query1 = $pdo -> prepare($sql1);
        $query1 -> execute(array($_FILES['avatar']['name'], $_SESSION['id']));

        if (!isset($_SESSION['erreur'])) {
            $_SESSION['avatar'] = $_FILES['avatar']['name'];
            $_SESSION['info'] = 'Avatar modifiée.';
            header('Location: index.php?action=monCompte');
        }
    } else {
        $_SESSION['erreur'] = 'Les modifications d\'avatar n\'ont pas été prises en compte.';
        header('Location: index.php?action=monCompte');
    }
}
?>