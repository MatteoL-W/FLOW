<?php

$referer = $_SERVER['HTTP_REFERER'];

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $sql = "UPDATE lien SET etat = ? WHERE idUtilisateur2 = ? AND idUtilisateur1 = ?";
    $query = $pdo->prepare($sql);
    $query -> execute(array('ami',$_SESSION['id'],$_GET['idAmi']));

    $_SESSION['info'] = 'Vous avez accepté la demande de cet utilisateur.';
    header("Location: $referer");

}

?>