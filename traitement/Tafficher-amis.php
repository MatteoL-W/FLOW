<?php

include("../config/config.php");
include("../config/bd.php"); // commentaire
session_start();

$limit = 5;
if (isset($_GET['limit']) && !empty($_GET['limit'])) {
    $limit = $_GET['limit'];
}

$sql = "SELECT user.id, user.avatar, user.login FROM user INNER JOIN lien ON idUtilisateur1=user.id AND etat='ami' AND idUTilisateur2=? UNION SELECT user.id, user.avatar, user.login FROM user INNER JOIN lien ON idUtilisateur2=user.id AND etat='ami' AND idUTilisateur1=? LIMIT $limit";
$query = $pdo->prepare($sql);
$query->execute(array($_SESSION['id'], $_SESSION['id']));

while ($line = $query->fetch()) {
    $pseudo = $line['login'];
    $avatar = $line['avatar'];
    $idAmi = $line['id'];

    echo "
                        <a href='index.php?action=profil&id=$idAmi' class='card'>
                            <div class='img_amis' style=\"background-image:url('upload/$avatar')\"></div>
                            <h3>$pseudo</h3>
                        </a>
                    ";
}
