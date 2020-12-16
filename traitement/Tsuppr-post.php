<?php

$referer = $_SERVER['HTTP_REFERER'];

if (isset($_GET['id'],$_SESSION['id']) && !empty ($_GET['id'])){
    
    $sql = "DELETE FROM ecrit WHERE idEcrit = ?";

    $query = $pdo->prepare($sql);
    $query -> execute(array($_GET['id']));

    $_SESSION['info'] = 'Post supprimé';
    $myId = $_SESSION['id'];
    header("Location: $referer");
} else {
    header("Location: index.php");
}

?>