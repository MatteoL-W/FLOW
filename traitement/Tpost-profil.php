<?php

$id = $_GET['id'];

if (isset($_POST['valider'], $_POST['post-profil']) && !empty($_POST['post-profil'])) {
    $image='';
    $sql = "INSERT INTO ecrit values(null, ?, ?, ?, ?, ?)";
    $query = $pdo -> prepare($sql);
    $query -> execute(array($_POST['post-profil'], date("Y-m-d H:i:s"), $image, $_SESSION['id'], $_GET['id']));
    header('Location: index.php?action=profil&id='.$_GET['id'].'');
} else {
    $_SESSION["erreur"]= "Merci de rentrer un message.";
    header('Location: index.php');
}

?>