<?php 

$idAmi = $_GET['id'];
$monId = $_SESSION['id'];
$addCancelled = false;
$referer = $_SERVER['HTTP_REFERER'];

if (isset($idAmi, $monId) && !empty($idAmi) && !empty($monId)) {
    $sql2 = "SELECT * FROM lien WHERE (idUtilisateur1 = ? AND idUtilisateur2 = ?) OR (idUtilisateur2 = ? AND idUtilisateur1 = ?) ";
    $query2 = $pdo->prepare($sql2);
    $query2->execute(array($monId,$idAmi,$monId,$idAmi));
    $line = $query2 -> fetch();

    if ($line) {
        $_SESSION['erreur'] = "La demande en ami n'a pas pu aboutir.";
        if ($line['etat'] == 'ami') {
            $_SESSION['erreur'] = $_SESSION['erreur'] . "<br>Vous êtes déjà en ami";
        } else if ($line['etat'] == 'banni') {
            $_SESSION['erreur'] = $_SESSION['erreur'] . "<br>Vous avez été banni par cet utilisateur.";
        } else if ($line['etat'] == 'attente') {
            $_SESSION['erreur'] = $_SESSION['erreur'] . "<br>L'invitation est déjà en attente";
        }
        $addCancelled = "true";
    }

    if ($addCancelled == false) {
        $sql = "INSERT INTO lien values(null, ?, ?, ?)";

        $query = $pdo->prepare($sql);
        $query->execute(array($monId, $idAmi, 'attente'));
    
        $_SESSION['info'] = "Demande en ami accordée";
    }

    /*
    
    header("Location: index.php?action=profil&id=$idAmi");
    */

    /*$_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['avatar'] = $_FILES['avatar']['name'];
    $_SESSION['info'] = 'Modification prise en compte';*/
    header("Location: $referer");
} else {
    $_SESSION['erreur'] = "La demande en ami n'a pas pu aboutir.";
    header("Location: $referer");
}


?>