<?php

include("../config/config.php");
include("../config/bd.php"); // commentaire
session_start();

$idPost = $_GET['idPost'];
$idPostAuteur = $_GET['idAuteur'];
$referer = $_SERVER['HTTP_REFERER'];


if (isset($idPost,$_SESSION['id'],$idPostAuteur) && !empty($_SESSION['id']) && !empty($idPost) && !empty($idPostAuteur)) {
    $sqlVerif = "SELECT * FROM post_like WHERE idPost = ? AND idPostAuteur = ? AND idLikeur = ?";
    $queryVerif = $pdo -> prepare($sqlVerif);
    $queryVerif -> execute(array($idPost,$idPostAuteur,$_SESSION['id']));
    $lineVerif = $queryVerif -> fetch();
    
    if ($lineVerif == true) {
        $sqlDelete = "DELETE FROM post_like WHERE idLike = ?";
        $queryDelete = $pdo -> prepare($sqlDelete);
        $queryDelete -> execute(array($lineVerif['idLike']));
        header("Location: $referer");
    } else {
        $sql = "INSERT INTO post_like values(null, ?, ?, ?)";
        $query = $pdo -> prepare($sql);
        $query -> execute(array($idPost,$idPostAuteur,$_SESSION['id']));
        header("Location: $referer");
    }
    
} else {
    $_SESSION["erreur"]= "Impossible de liker";
    header('Location: $referer');
}

?>