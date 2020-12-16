<section id="profil" class="split-menu">
    <?php include("divers/header.php"); ?>

<div id="screen">
    <div class="accueil">
        <div class="logo-accueil">
            <img src="ressources/logo-flow.png" alt="Logo FLOW">
        </div>

        <?php
        echo "

        <h1 style='margin-top: 30px'>Poster sur le profil</h1>
        <form enctype='multipart/form-data' action='index.php?action=Tpost-profil&id=".$_SESSION['id']."' method='post'>
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
        ?>
        
        <h1>Les derniers posts</h1>

        <div id="all-posts"></div>

        

    </div>
    <input type='submit' value='Voir plus' class='btn-default' id='accueil_vp'>


</section>