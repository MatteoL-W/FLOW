<?php 
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        if ($_SESSION['id'] == $_GET['id']) {
            $myAccount = true;
        } else {
            $myAccount = false;
        }
    } else {
        header("Location: index.php?action=profil&id=".$_SESSION['id']."");
    }

    $sql = "SELECT *, TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) AS age FROM user WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query -> execute(array($_GET['id']));
    $line = $query -> fetch();

    if ($line) {
        $pseudo = $line['login'];
        $banniere = $line['banniere'];
        $interets = $line['interets'];
        $biographie = $line['biographie'];
        $naissance = $line['date_naissance'];
        $age = $line['age'];
    }

    $isFriend = true;

    $sql5 = "SELECT * FROM lien WHERE ((idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?)) AND etat ='ami'";
    $query5 = $pdo->prepare($sql5);
    $query5 -> execute(array($_GET['id'],$_SESSION['id'],$_SESSION['id'],$_GET['id']));
    $line5 = $query5 -> fetch();

    if ($line5 == false) {
        $isFriend = false;
    }


?>

<section id="profil" class="split-menu">
    <?php include("divers/header.php"); ?>

    <div id="screen">
        <!-- modif bannere -->
        <div class="profil-banner" style="background-image: url('upload/<?=$line['banniere']?>')">
        </div>

        <!-- modif avatar -->
        <div class="profil-avatar" style="background-image: url('upload/<?=$line['avatar']?>')">
            <?php 
                if ($myAccount == false && $isFriend == false) {
                    echo "<form action='index.php?action=Tajouter-ami&id=".$_GET['id']."' method='post'>
                    <input type='submit' src='ressources/loupe.png' value='' name='valider'>
                    </form>";
                } else if ($myAccount == false && $isFriend == true) {
                    echo "<form action='index.php?action=Tretirer-ami&id=".$_GET['id']."' method='post'>
                    <input type='submit' src='ressources/loupe.png' value='' name='valider' class='retirer'>
                    </form>";
                }
            ?> 
        </div>
        
        <div class="flex-profil">
            <div class="profil" id="profil1">
                <!-- ajouter age -->
                <h1><?= $pseudo ?>, <?= $age ?> ans</h1> 
                <h2><?= $interets ?></h2>
                <p><?= $biographie ?></p>
                <ul>
                <?php

                    $sql2 = "SELECT * FROM reseaux JOIN user ON reseaux.idUser = user.id WHERE reseaux.idUser = ?";
                    $query2 = $pdo->prepare($sql2);
                    $query2 -> execute(array($_GET['id']));
                    $rs_nul = true;
                    $rs = ['','Soundcloud','Youtube','Behance','Instagram','Twitter','Facebook','Pinterest'];
                    $line2 = $query2 -> fetch();

                    for ($i = 1; $i < count($rs); $i++) {
                        if (!empty($line2[$i])) {
                            $rs_nul = false;
                            $nom = strtolower($rs[$i]);
                            $lien = $line2["$nom"];
                            echo "<li>
                                $rs[$i]:
                                <a href='$lien'>$lien</a>
                            </li>";
                        }
                    }

                    if ($rs_nul == true) {
                        echo "Aucun réseau social renseigné ici !";
                    }


                ?>
                </ul>

                <?php
                    if ($myAccount == true) {
                        echo "

                        <h1 style='margin-top: 30px'>Poster sur le profil</h1>
                        <form enctype='multipart/form-data' action='index.php?action=Tpost-profil&id=".$_GET['id']."' method='post'>
                            <textarea name='post-profil' placeholder='Tapez votre message ici' rows='4' id='textarea_post'></textarea><br>
                            <img src='ressources/image-gallery.svg' alt='Galerie' id='galerie'>
                            <img src='ressources/musical-note.svg' alt='Galerie' id='img_music'>
                            <img src='' id='display_image' alt='image_user' style='display:none'>
                            <p id='display_son' alt='son_user' style='display:none'></p>
                            <input type='file' name='image' id='image_post' style='display:none;' accept='image/png, image/jpeg, image/jpg'>
                            <input type='file' name='son' id='son_post' accept='.mp3' style='display:none;'>
                            <input type='submit' name='valider' value='Envoyer' class='btn-default'>
                        </form>

                        ";
                    }
                ?>
                

                    
                

                <h1 style="margin-top: 30px">Posts</h1>

                <div id="fleche"></div>

                <?php  
                
                $sql3 = "SELECT * FROM ecrit
                    JOIN user ON ecrit.idAmi = user.id
                    WHERE idAmi = ? AND idAmi = idAuteur
                    ORDER BY dateEcrit DESC";
                $query3 = $pdo->prepare($sql3);
                $query3 -> execute(array($line['id']));
                $post_nul = true;

                while ($line3 = $query3 -> fetch()) {
                    $post_nul = false;
                    $date = $line3['dateEcrit'];
                    $date = explode(" ", $date);
                    $ecrit = $line3['idEcrit'];
                    $image = $line3['image'];

                    $nbLikes = 0;
                    $icone = "like";

                    $sqlLike = "SELECT * FROM post_like WHERE idPost = ?";
                    $querySql = $pdo->prepare($sqlLike);
                    $querySql -> execute(array($ecrit));

                    while ($lineSql = $querySql -> fetch()) {
                        $nbLikes++;
                        if ($lineSql['idLikeur'] == $_SESSION['id']) {
                            $icone = "liked";
                        }
                    }
                    
                    echo "
                    <div class='post'>
                        <div class='img_posteur' style='background-image:url(upload/".$line3['avatar'].")'></div>
                        <p class='pseudo'>".$line3['login']."</p>
                        <p>".$line3['contenu']."</p>";

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
                        <a href='index.php?action=Tlikepost&idPost=$ecrit&idAuteur=".$line3['id']."'>
                            <img class='post_like' src='ressources/$icone.svg' alt='like' width='30px' height='30px'>
                        </a>
                    </div>

                    <div class='flex_compl_comm'><p class='post_commentaire'>Posté le ".$date[0]." à ".$date[1]." ";

                    if ($myAccount == true) {  
                        echo "<a href='index.php?action=Tsuppr-post&id=".$line3['idEcrit']."'>Supprimer</a></p>";
                    } else {
                        echo "</p>";
                    }

                    

                    if ($nbLikes != 0) {
                        if ($nbLikes == 1) {
                            echo "<p data-id='$ecrit' class='post_commentaire clickForLikes'>$nbLikes personne a aimé ce post</p></div>";
                        } else {
                            echo "<p data-id='$ecrit' class='post_commentaire clickForLikes'>$nbLikes personnes ont aimés ce post</p></div>";
                        }
                        
                    } else {
                        echo "<p class='post_commentaire'>Personne n'a aimé ce post</p></div>";
                    }
                    
                }

                if ($post_nul == true) {
                    echo "<p>Aucun post de l'utilisateur.</p>";
                }

                ?>
            </div>

            <div class="profil" id="profil2">

                
                <?php
                    if ($myAccount == false) {
                        echo "<h1>Poster dans le livre d'or</h1>";
                        if ($isFriend == true) {
                            echo "
                            <form enctype='multipart/form-data' action='index.php?action=Tpost-profil&id=".$_GET['id']."' method='post'>
                                <textarea name='post-profil' placeholder='Tapez votre message ici' rows='4' id='textarea_post'></textarea><br>
                                <img src='ressources/image-gallery.svg' alt='Galerie' id='galerie'>
                                <img src='ressources/musical-note.svg' alt='Galerie' id='img_music'>
                                <img src='' id='display_image' alt='image_user' style='display:none'>
                                <p id='display_son' alt='son_user' style='display:none'></p>
                                <input type='file' name='image' id='image_post' style='display:none;' accept='image/png, image/jpeg, image/jpg'>
                                <input type='file' name='son' id='son_post' accept='.mp3' style='display:none;'>
                                <input type='submit' name='valider' value='Envoyer' class='btn-default'>
                            </form>

                            ";
                        } else {
                            echo "<p>Vous n'êtes pas en ami. Devenez ami avec cette personne pour accéder à son livre d'or !</p>";
                        }
                    } else 
                ?>
                <h1>Livre d'or</h1>
                <?php
                
                $sql4 = "SELECT * FROM ecrit
                        JOIN user ON ecrit.idAuteur = user.id
                        WHERE idAmi = ? AND idAmi <> idAuteur
                        ORDER BY dateEcrit DESC";
                $query4 = $pdo->prepare($sql4);
                $query4 -> execute(array($_GET['id']));
                $livre_or_nul = true;

                while ($line4 = $query4 -> fetch()) {
                    
                    $image2 = $line4['image'];
                    $nbLikes = 0;
                    $icone = "like";
                    $idPost = $line4['idEcrit'];

                    $sqlLike = "SELECT * FROM post_like WHERE idPost = ?";
                    $querySql = $pdo->prepare($sqlLike);
                    $querySql -> execute(array($idPost));

                    while ($lineSql = $querySql -> fetch()) {
                        $nbLikes++;
                        if ($lineSql['idLikeur'] == $_SESSION['id']) {
                            $icone = "liked";
                        }
                    }

                    $livre_or_nul = false;
                    $date = $line4['dateEcrit'];
                    $date = explode(" ", $date);
                    // IMG POSTEUR
                    echo "
                    <a href='index.php?action=profil&id=".$line4['idAuteur']."'>
                    <div class='post'>
                        <div class='img_posteur' style='background-image:url(upload/".$line4['avatar'].")'></div>
                        <p class='pseudo'>".$line4['login']."</p>
                        <p>".$line4['contenu']."</p>";

                        if (!empty($image2)) {
                            $format = explode(".",$image2);
                            $format = $format[1];
                
                            if ($format == 'png' || $format == 'jpg' || $format == 'jpeg') {
                                echo "<a href='upload/$image2' data-lightbox='$image2'><img class='img_post' src='upload/$image2' alt='image-1' /></a>";
                            } else if ($format == 'mp3') {
                                echo "<audio
                                    controls
                                    src='upload/$image2'>
                                        Your browser does not support the
                                        <code>audio</code> element.
                                    </audio>";
                            }
                        }

                    echo "
                        <a href='index.php?action=Tlikepost&idPost=$idPost&idAuteur=".$line4['id']."'>
                            <img class='post_like' src='ressources/$icone.svg' alt='like' width='30px' height='30px'>
                        </a>
                    </div>
                    </a>

                    <div class='flex_compl_comm'><p class='post_commentaire'>Posté le ".$date[0]." à ".$date[1]." ";

                    if ($line4['idAuteur'] == $_SESSION['id']) {
                        echo "<a href='index.php?action=Tsuppr-post&id=".$line4['idEcrit']."'>Supprimer</a></p>";
                    } else {
                        echo "</p>";
                    }

                    

                    if ($nbLikes != 0) {
                        if ($nbLikes == 1) {
                            echo "<p class='post_commentaire'>$nbLikes personne a aimé ce post</p></div>";
                        } else {
                            echo "<p class='post_commentaire'>$nbLikes personnes ont aimés ce post</p></div>";
                        }
                        
                    } else {
                        echo "<p class='post_commentaire'>Personne n'a aimé ce post</p></div>";
                    }
                }
                
                if ($livre_or_nul == true) {
                    echo "<p>Aucun post dans le livre d'or...</p>";
                }

                ?>


                <div id="fleche2"></div>
                
            </div>
        </div>
        

        

        
    </div>
</section>