<section id="amis" class="split-menu">
    <?php include("divers/header.php"); ?>

    <div id="screen">
        <div class="amis">
            <h1>Mes amis</h1>
            <div class="flex-card" id="amis_container">
                <?php 
                

                ?>
                

            </div>
                
            <input type="submit" value="Voir plus" class="btn-default" id="amis_vp">

            <div class='recherche-flex'>
                <form action="index.php?action=mesAmis" class="recherche" method='post'>
                    <input type="text" placeholder="Rechercher des profils avec un pseudo" name="recherche">
                    <input type="submit" src="ressources/loupe.png" value="" name='valider'>
                </form>

                <form action="index.php?action=mesAmis" class="recherche" method='post'>
                    <input type="text" placeholder="Rechercher des profils avec des intérêts" name="rechercheInterets">
                    <input type="submit" src="ressources/loupe.png" value="" name='valider'>
                </form>
            </div>
            

            


            <div class="liste-amis">
            <?php
                if (isset($_POST['valider'],$_POST['recherche']) && !empty($_POST['recherche'])) {
                    $sql = "SELECT *, TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) AS age FROM user WHERE login LIKE ? LIMIT 3";                    
                    $query = $pdo->prepare($sql);
                    $query -> execute(array(   '%'. $_POST['recherche'] . '%'   ));
                    $nul = true;

                    while ($line = $query -> fetch()) {
                        if ($line['id'] != $_SESSION['id']) {

                        $avatar = $line['avatar'];
                        
                        echo "<div class='post'>
                                <a href='index.php?action=profil&id=".$line['id']."'>
                                <div class='img_posteur' style=\"background-image: url('upload/$avatar');\"></div>
                                <p class='pseudo'>".$line['login'].", ".$line['age']."</p>
                                <p class='interets'>".$line['interets']."</p>
                                <p class='biographie'>".$line['biographie']."</p>
                                <a href='index.php?action=Tajouter-ami&id=".$line['id']."' class='btn-default btn-add-amis' name='valider' >Ajouter en ami</a>
                            </a>
                        </div>";
                        $nul = false;                             
                        }
                    }

                    if ($nul == true) {
                        echo "<p>Aucun utilisateur avec ce pseudo</p>";
                    }
                }

            ?>                
            </div>

            
            <div class="liste-amis">
            <?php
                if (isset($_POST['valider'],$_POST['rechercheInterets']) && !empty($_POST['rechercheInterets'])) {
                    $sql2 = "SELECT *, TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) AS age FROM user WHERE interets LIKE ? LIMIT 3";                    
                    $query2 = $pdo->prepare($sql2);
                    $query2 -> execute(array(   '%'. $_POST['rechercheInterets'] . '%'   ));
                    $nul = true;

                    while ($line2 = $query2 -> fetch()) {
                        if ($line2['id'] != $_SESSION['id']) {
                            $avatar2 = $line2['avatar'];
                            
                            echo "<div class='post'>
                                    <a href='index.php?action=profil&id=".$line2['id']."'>
                                    <div class='img_posteur' style='background-image: url(upload/$avatar2);'></div>
                                    <p class='pseudo'>".$line2['login'].", ".$line2['age']."</p>
                                    <p class='interets'>".$line2['interets']."</p>
                                    <p class='biographie'>".$line2['biographie']."</p>
                                    <a href='index.php?action=Tajouter-ami&id=".$line2['id']."' class='btn-default btn-add-amis' name='valider' >Ajouter en ami</a>
                                </a>
                            </div>";
                            $nul = false;
                        }
                    }

                    if ($nul == true) {
                        echo "<p>Aucun utilisateur avec cet intérêt</p>";
                    }
                }

            ?>                
            </div>

            <h1>Ils ne vous ont pas encore répondus</h1>
            <div class="liste-non-rep">
            <?php 
                
                $sql2 = "SELECT user.* FROM user INNER JOIN lien ON user.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?";
                $query2 = $pdo->prepare($sql2);
                $query2->execute(array($_SESSION['id']));
                $nul = true;
                
                while ($line2 = $query2 -> fetch()) {
                    $nul = false;
                    $pseudo = $line2['login'];
                    $interets = $line2['interets'];
                    $biographie = $line2['biographie'];
                    $avatar = $line2['avatar'];
                    $idAmi = $line2['id'];

                    echo "<a href='index.php?action=profil&id=$idAmi'>
                            <div class='post'>
                                <div class='img_posteur' style='background-image: url(upload/$avatar);'></div>
                                <p class='pseudo'>$pseudo, 27 ans</p>
                                <p class='interets'>$interets</p>
                                <p class='biographie'>$biographie</p>
                            </div>
                        </a>
                    ";
                }

                if ($nul == true) {
                    echo "<p>Vous n'avez aucune demande en attente, parfait !</p>";
                }

            ?>

            </div>

            <h1>Ils attendent votre réponse</h1>

            <div class="liste-a-confirm">
            <?php 
                
                $sql3 = "SELECT user.* FROM user WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente')";
                $query3 = $pdo->prepare($sql3);
                $query3->execute(array($_SESSION['id']));
                $nul2 = true;
                
                while ($line3 = $query3 -> fetch()) {
                    $nul2 = false;
                    $pseudo = $line3['login'];
                    $interets = $line3['interets'];
                    $biographie = $line3['biographie'];
                    $avatar = $line3['avatar'];
                    $idAmi = $line3['id'];

                    echo "<div class='post'>
                            <a href='index.php?action=profil&id=$idAmi'>
                                <div class='img_posteur' style='background-image: url(upload/$avatar)'></div>
                                <p class='pseudo'>$pseudo</p>
                                <p class='interets'>$interets</p>
                                <p class='biographie'>$biographie</p>
                            </a>
                            <div class='flex-oui-non'>
                                <a href='index.php?action=Trefuser-ami&idAmi=$idAmi'>-</a>
                                <a href='index.php?action=Taccepter-ami&idAmi=$idAmi'>+</a>
                            </div>
                        </div>
                    ";
                }

                if ($nul2 == true) {
                    echo "<p>Vous n'avez aucune demande en attente !</p>";
                }

            ?>
            </div>
            
            
        </div>
    </div>
</section>