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
        $avatar = $line['avatar'];
        $banniere = $line['banniere'];
        $interets = $line['interets'];
        $biographie = $line['biographie'];
        $naissance = $line['date_naissance'];
        $age = $line['age'];
    }
?>

<section id="profil" class="split-menu">
    <?php include("divers/header.php"); ?>

    <div id="screen">
        <!-- modif bannere -->
        <div class="profil-banner">
        </div>

        <!-- modif avatar -->
        <div class="profil-avatar">
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
                    $rs = ['','Soundcloud','Youtube','Behance','Instagram','Twitter','Facebook','Pinterest'];
                    $line2 = $query2 -> fetch();

                    for ($i = 1; $i < count($rs); $i++) {
                        if (!empty($line2[$i])) {$nom = strtolower($rs[$i]);
                            $lien = $line2["$nom"];
                            echo "<li>
                                $rs[$i]:
                                <a href='$lien'>$lien</a>
                            </li>";
                        }
                    }


                ?>
                </ul>

                <?php
                    if ($myAccount == true) {
                        echo "

                        <h1 style='margin-top: 30px'>Poster sur le profil</h1>
                        <form action='index.php?action=Tpost-profil&id=".$_GET['id']."' method='post'>
                            <textarea name='post-profil' placeholder='Tapez votre message ici' rows='4'></textarea><br>
                            <input type='submit' name='valider' value='Envoyer' class='btn-default'>
                        </form>

                        ";
                    }
                ?>
                

                    
                

                <h1 style="margin-top: 30px">Posts</h1>

                <div id="fleche"></div>

                <?php 
                
                $sql = "SELECT * FROM ecrit
                    JOIN user ON ecrit.idAmi = user.id
                    WHERE idAmi = ? AND idAmi = idAuteur
                    ORDER BY dateEcrit DESC";
                $query = $pdo->prepare($sql);
                $query -> execute(array($line['id']));

                while ($line = $query -> fetch()) {
                    $date = $line['dateEcrit'];
                    $date = explode(" ", $date);
                    // IMG POSTEUR
                    echo "
                    
                    <div class='post'>
                        <div class='img_posteur'></div>
                        <p class='pseudo'>".$line['login']."</p>
                        <p>".$line['contenu']."</p>
                    </div>

                    <p class='post_commentaire'>Posté le ".$date[0]." à ".$date[1]." ";

                    if ($myAccount == true) {  
                        echo "<a href=''>Supprimer</a></p>";
                    } else {
                        echo "</p>";
                    }
                }

                ?>
            
                <input type="button" value="Voir plus" class="btn-default">
            </div>

            <div class="profil" id="profil2">
                
                <?php
                    if ($myAccount == false) {
                        echo "

                        <h1>Poster dans le livre d'or</h1>
                        <form action='index.php?action=Tpost-profil&id=".$_GET['id']."' method='post'>
                            <textarea name='post-profil' placeholder='Tapez votre message ici' rows='4'></textarea><br>
                            <input type='submit' name='valider' value='Envoyer' class='btn-default'>
                        </form>

                        ";
                    }
                ?>
                <h1>Livre d'or</h1>
                <?php
                
                $sql = "SELECT * FROM ecrit
                        JOIN user ON ecrit.idAuteur = user.id
                        WHERE idAmi = ? AND idAmi <> idAuteur
                        ORDER BY dateEcrit DESC";
                $query = $pdo->prepare($sql);
                $query -> execute(array($_GET['id']));


                while ($line = $query -> fetch()) {
                    $date = $line['dateEcrit'];
                    $date = explode(" ", $date);
                    // IMG POSTEUR
                    echo "
                    
                    <div class='post'>
                        <div class='img_posteur'></div>
                        <p class='pseudo'>".$line['login']."</p>
                        <p>".$line['contenu']."</p>
                    </div>

                    <p class='post_commentaire'>Posté le ".$date[0]." à ".$date[1]." ";

                    if ($myAccount == true) {  
                        echo "<a href=''>Supprimer</a></p>";
                    }
                }
                
                ?>


                <div id="fleche2"></div>

                
            </div>
        </div>
        

        

        
    </div>
</section>