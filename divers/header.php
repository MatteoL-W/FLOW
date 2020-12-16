    <?php 
    
    if (!isset($_SESSION['id'])) {
        $_SESSION['erreur'] = 'Merci de vous connecter pour accéder à cette page';
        header('Location:index.php?action=connexion');
    }

    ?>

    <header id="menu">
        <a href="index.php?action=profil&id=<?=$_SESSION['id']?>">
            <div class="img_avatar_menu" style="background-image:url('upload/<?=$_SESSION['avatar']?>')">
            </div>
            <div class="flex_menu">
                <h1><?=$_SESSION['pseudo']?></h1>
                <nav>
                <a href="index.php?action=accueil">Mon fil</a>
                    <a href="index.php?action=profil&id=<?=$_SESSION['id']?>">Mon profil</a>
                    <a href="index.php?action=mesAmis">Mes amis</a>
                    <a href="index.php?action=monCompte">Mon compte</a>
                    <a href="index.php?action=Tdeconnexion">Déconnexion</a>
                </nav>
            </div>
        </a>
    </header>