<?php

include("../config/config.php");
include("../config/bd.php"); // commentaire
session_start();

$limit = 10;
if (isset($_GET['limit']) && !empty($_GET['limit'])) {
    $limit = $_GET['limit'];
}

$sql = "SELECT ecrit.*, user1.id, user2.id, user1.login, user2.login, user1.avatar, user2.avatar FROM ecrit 
        JOIN user as user1 ON user1.id = ecrit.idAuteur 
        JOIN user as user2 ON user2.id = ecrit.idAmi
        WHERE idAuteur IN(SELECT user.id FROM user INNER JOIN lien ON idUtilisateur1=user.id AND etat='ami' AND idUTilisateur2=? UNION SELECT user.id FROM user INNER JOIN lien ON idUtilisateur2=user.id AND etat='ami' AND idUTilisateur1=?)
        OR idAmi IN(SELECT user.id FROM user INNER JOIN lien ON idUtilisateur2=user.id AND etat='ami' AND idUTilisateur1=? UNION SELECT user.id FROM user INNER JOIN lien ON idUtilisateur1=user.id AND etat='ami' AND idUTilisateur2=?)
        OR (idAuteur = idAmi AND idAuteur = ?)
        ORDER BY dateEcrit DESC
        LIMIT $limit";

$query = $pdo->prepare($sql);
$query->execute(array($_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id']));


while ($line = $query->fetch()) {
    $idPost = $line['idEcrit'];
    $idAuteur = $line[6];
    $idRecepteur = $line[7];
    $contenu = $line['contenu'];
    $pseudoAuteur = $line[8];
    $pseudoRecepteur = $line[9];
    $imgAuteur = $line[10];
    $imgRecepteur = $line[11];
    $date = $line['dateEcrit'];
    $date = explode(" ", $date);
    $image = $line['image'];

    $nbLikes = 0;
    $icone = "like";

    $sqlLike = "SELECT * FROM post_like WHERE idPost = ?";
    $querySql = $pdo->prepare($sqlLike);
    $querySql->execute(array($idPost));

    while ($lineSql = $querySql->fetch()) {
        $nbLikes++;
        if ($lineSql['idLikeur'] == $_SESSION['id']) {
            $icone = "liked";
        }
    }



    if ($line['idAuteur'] == $line['idAmi']) {
        echo "
                <div class='post'>
                    <a href='index.php?action=profil&id=$idAuteur'>
                        <div class='img_posteur' style='background-image:url(upload/" . $line['avatar'] . ")'></div>
                        <p class='pseudo'>" . $line['login'] . "</p>
                    </a>
                    <p>" . $line['contenu'] . "</p>";

        if (!empty($image)) {
            $format = explode(".",$image);
            $format = $format[1];

            if ($format == 'png' || $format == 'jpg' || $format == 'jpeg') {
                echo "<a href='upload/$image' data-lightbox='$image'><img class='img_post' src='upload/$image' alt='image-1' /></a>";
            } else if ($format == 'mp3') {
                echo "<audio
                    controls
                    src='upload/$image'>
                        Your browser does not support the
                        <code>audio</code> element.
                    </audio>";
            } 
        }

        echo "
                    
                        <img class='post_like' src='ressources/$icone.svg' alt='like' width='30px' height='30px' data-id='$idPost' data-idAuteur = '$idAuteur'>
                    
                </div>

                <div class='flex_compl_comm'><p class='post_commentaire'>Posté le " . $date[0] . " à " . $date[1] . " ";
                if ($idAuteur == $_SESSION['id']) {
                    echo "<a href='index.php?action=Tsuppr-post&id=$idPost'>Supprimer</a></p>";
                } else {
                    echo "</p>";
                }
    } else {
        echo "
                    <div class='post'>
                        <a href='index.php?action=profil&id=$idAuteur'>
                            <div class='img_posteur' style='background-image:url(upload/$imgAuteur)'></div>
                        </a>
                        <a href='index.php?action=profil&id=$idRecepteur'>
                            <div class='img_recepteur' style='background-image:url(upload/$imgRecepteur)'></div>
                        </a>
                        <p class='pseudo'>
                        <a href='index.php?action=profil&id=$idAuteur'>$pseudoAuteur</a>
                         &#8594;
                        <a href='index.php?action=profil&id=$idRecepteur'>$pseudoRecepteur</a>
                        </p>
                        <p>$contenu</p>";

        if (!empty($image)) {
                            $format = explode(".",$image);
                            $format = $format[1];
                
                            if ($format[1] == 'png' || $format == 'jpg' || $format == 'jpeg') {
                                echo "<a href='upload/$image' data-lightbox='$image'><img class='img_post' src='upload/$image' alt='image-1' /></a>";
                            } else if ($format == 'mp3') {
                                echo "<audio
                                    controls
                                    src='upload/$image'>
                                        Your browser does not support the
                                        <code>audio</code> element.
                                    </audio>";
                            }
                        }

        /*<a href='index.php?action=Tlikepost&idPost=$idPost&idAuteur=$idAuteur'>*/
                        echo "
                        <a href='#'>
                            <img class='post_like' src='ressources/$icone.svg' alt='like' width='30px' height='30px' data-id='$idPost' data-idAuteur = '$idAuteur'>
                        </a>
                    </div>
                    <div class='flex_compl_comm'><p class='post_commentaire'>Posté le " . $date[0] . " à " . $date[1] . " ";
                    if ($idAuteur == $_SESSION['id'] || $idRecepteur == $_SESSION['id']) {
                        echo "<a href='index.php?action=Tsuppr-post&id=$idPost'>Supprimer</a></p>";
                    } else {
                        echo "</p>";
                    }
    }
    if ($nbLikes != 0) {
        if ($nbLikes == 1) {
            echo "<p data-id='$idPost' class='post_commentaire clickForLikes'>$nbLikes personne a aimé ce post</p></div>";
        } else {
            echo "<p data-id='$idPost' class='post_commentaire clickForLikes'>$nbLikes personnes ont aimés ce post</p></div>";
        }
    } else {
        echo "<p class='post_commentaire'>Personne n'a aimé ce post</p></div>";
    }
    

}