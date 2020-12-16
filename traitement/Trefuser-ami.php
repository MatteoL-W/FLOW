<?php

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $sql = "UPDATE lien SET etat = ? WHERE idUtilisateur2 = ? AND idUtilisateur1 = ?";
    $query = $pdo->prepare($sql);
    $query -> execute(array('banni',$_SESSION['id'],$_GET['idAmi']));

    $_SESSION['info'] = 'Vous avez refusé la demande de cet utilisateur.';
    header('Location: index.php?action=mesAmis');

}

?>