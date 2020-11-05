    <header id="menu">
        <a href="index.php?action=profil&id=<?=$_SESSION['id']?>">
            <div class="img_avatar_menu">
            </div>
            <div class="flex_menu">
                <h1><?=$_SESSION['pseudo']?></h1>
                <nav>
                    <a href="index.php?action=profil&id=<?=$_SESSION['id']?>">Mon profil</a>
                    <a href="index.php?action=mesAmis">Mes amis</a>
                    <a href="index.php?action=monCompte">Mon compte</a>
                    <a href="index.php?action=Tdeconnexion">Déconnexion</a>
                </nav>
            </div>
        </a>
    </header>