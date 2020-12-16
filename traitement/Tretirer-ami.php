<?php 

$idAmi = $_GET['id'];
$monId = $_SESSION['id'];
$addCancelled = false;
$referer = $_SERVER['HTTP_REFERER'];

if (isset($idAmi, $monId) && !empty($idAmi) && !empty($monId)) {

    $sql = "UPDATE lien SET etat = 'banni' WHERE (idUtilisateur1 = ? AND idUtilisateur2 = ?) OR (idUtilisateur2 = ? AND idUtilisateur1 = ?) AND etat = 'ami'";
    $query = $pdo->prepare($sql);
    $query->execute(array($monId,$idAmi,$monId,$idAmi));

    $_SESSION['info'] = "Vous avez retiré cette personne de vos amis";
    header("Location: $referer");
} else {
    $_SESSION['erreur'] = "La suppression de cet ami n'a pas pu aboutir.";
    header("Location: $referer");
}


?>