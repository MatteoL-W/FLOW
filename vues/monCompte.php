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
        <div class="profil-banner" id='btnChangerBanniere' style="background-image: url('upload/<?=$line['banniere']?>')">
            <img src="ressources/edit.png" alt="Editer la bannière">
        </div>

        <div class="profil-avatar" id='btnChangerAvatar'style="background-image: url('upload/<?=$line['avatar']?>')">
            <img src="ressources/edit.png" alt="Editer la bannière" class="myAccount">
        </div>

        <div class="flex-bouton">
            <form enctype="multipart/form-data" action="index.php?action=Tmodifavatar" method="post" >
                <input type="file" accept="image/png, image/jpeg" id='changerAvatar' name="avatar"  class="italic-input" style='display:none;'>
                <input class='btn-default bouton-avatar' type='submit' value="Prendre en compte la modification de l'avatar" name='valider'>
            </form>

            <form enctype="multipart/form-data" action="index.php?action=Tmodifbanniere" method="post" >
                <input type="file" accept="image/png, image/jpeg" id='changerBanniere' name="banniere"  class="italic-input"style='display:none;'>
                <input class='btn-default bouton-avatar' type='submit' value="Prendre en compte la modification de la bannière" name='valider'>
            </form>
        </div>

        <form enctype="multipart/form-data" class="monCompte" action='index.php?action=Tmodifcompte' method="post" >
            <input name="pseudo" type="text" value="<?=$line['login']?>" class="big-input"> 
            <input name="age" type="date" value="<?=$line['date_naissance']?>" min="1930-01-01" max="2010-12-31" class="big-input"><br>
            <input name="interets" placeholder='Renseignez vos intérêts (peinture, rap, ...)' type="text" value="<?=$line['interets']?>" class="italic-input"><br>
            <input name="email" type="email" value="<?=$line['email']?>" class="italic-input"><br>
            <textarea name="biographie" rows="4" placeholder="Renseignez une brève biographie..."><?=$line['biographie']?></textarea><br>
            
            <div>
                <?php 
                
                    $rs = ['','Soundcloud','Youtube','Behance','Instagram','Twitter','Facebook','Pinterest'];
                    for ($i = 1; $i < count($rs); $i++) {
                        $nompetit = strtolower($rs[$i]);
                        echo "

                        <label for='$rs[$i]'>$rs[$i]:</label>
                        <input type='text' name='$nompetit' value='" .$line[$i + 10]. "' placeholder='http://$nompetit.com/' class='lien'><br>

                        ";
                        
                    }

                ?>
            </div>

            <input type="submit" class="btn-default" name='valider' value="Effectuer les modifications" style="margin-bottom: 15px">
        </form>
        

        
    </div>
</section>