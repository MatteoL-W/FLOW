<section id="compte" class="split-menu">
    <?php include("divers/header.php"); ?>

    <?php
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $sql = "SELECT * FROM user JOIN reseaux ON user.id = reseaux.idUser WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute(array($_SESSION['id']));
        $line = $query->fetch();

    } else {
        $_SESSION['erreur'] = 'Merci de vous connecter.';
        header('Location: index.php');
    }

    ?>

    <div id="screen">
        <div class="profil-banner" id='btnChangerBanniere'>
            <img src="ressources/edit.png" alt="Editer la bannière">
        </div>

        <div class="profil-avatar" id='btnChangerAvatar'>
            <img src="ressources/edit.png" alt="Editer la bannière">
        </div>

        <form enctype="multipart/form-data" class="monCompte" action='index.php?action=Tmodifcompte' method="post">
            <input name="pseudo" type="text" value="<?=$line['login']?>" class="big-input"> 
            <input name="age" type="date" value="<?=$line['date_naissance']?>" class="big-input"><br>
            <input type="file" accept="image/png, image/jpeg" id='changerAvatar' name="avatar"  class="italic-input">
            <input type="file" accept="image/png, image/jpeg" id='changerBanniere' name="banniere" class="italic-input">
            <input name="interets" placeholder='Renseignez vos intérêts (peinture, rap, ...)' type="text" value="<?=$line['interets']?>" class="italic-input"><br>
            <input name="email" type="text" value="<?=$line['email']?>" class="italic-input"><br>
            <textarea name="biographie" rows="4" placeholder="Renseignez une brève biographie..."><?=$line['biographie']?></textarea><br>
            
            <div>
                <?php 
                
                    $rs = ['','Soundcloud','Youtube','Behance','Instagram','Twitter','Facebook','Pinterest'];
                    for ($i = 1; $i < count($rs); $i++) {
                        echo "

                        <label for='$rs[$i]'>$rs[$i]:</label>
                        <input type='text' name='soundcloud' value='" .$line[$i + 10]. "' class='lien'><br>

                        ";
                        
                    }

                ?>
            </div>

            <input type="submit" class="btn-default" name='valider' value="Effectuer les modifications">
        </form>

        <div class="changerInfos">
            <span class="btn-default">Changer de mot de passe</span>
            <span class="btn-default">Changer d'adresse mail</span>
        </div>
        

        
    </div>
</section>