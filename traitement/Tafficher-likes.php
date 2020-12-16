<!--<div id="displayLikes">
    <h2>Likes:</h2>
    <div class="all-likes" id="all-likes">-->

<?php

include("../config/config.php");
include("../config/bd.php"); // commentaire
session_start();

$sql = "SELECT DISTINCT user.id, user.login, user.avatar FROM post_like
    JOIN user ON user.id = post_like.idLikeur
    WHERE user.id IN(SELECT idLikeur FROM post_like WHERE idPost = ?)";
$query = $pdo->prepare($sql);
$query->execute(array($_GET['idPost']));

while ($line = $query->fetch()) {
    $id = $line['id'];
    $pseudo = $line['login'];
    $avatar = $line['avatar'];

    echo "
    <div class='like'>
            <a href='index.php?action=profil&id=$id'>
                <div class='img_liker' style='background-image:url(upload/$avatar)'> </div>
                <p class='pseudo_liker'>$pseudo</p>
            </a>
        </div>
    ";
}    

?>

<!--</div>
</div>-->