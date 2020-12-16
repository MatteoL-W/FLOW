<?php
/*

if (isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['pwd'] = $_POST['mdp'];

    $sql = "INSERT INTO user(login,mdp,email) VALUES (?,PASSWORD(?),?)";
    $q = $pdo->prepare($sql);
    $q -> execute(array($_POST['login'],$_POST['mdp'],$_POST['email']));

    echo "Votre contré est cré";
} else {
    header("Location: ../index.php?action=create");
}*/

$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$mdp1 = $_POST['mdp1'];
$mdp2 = $_POST['mdp2'];
$dn = $_POST['date_naissance'];
$avatar = 'flow-user.jpg';

// SI ON RECOIT LES VARIABLES
if (isset($_POST['valider'], $email, $pseudo, $mdp1, $mdp2, $dn)
    && (!empty($email) && !empty($pseudo) && !empty($mdp1) && !empty($mdp2) && !empty($dn)) 
    && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    && valideDate($dn, 'Y-m-d')) {
        
        // MDP IDENTIQUE
        if ($mdp1 == $mdp2) {
            $sql = "SELECT login FROM user WHERE login = ? OR email = ?";
            $query = $pdo->prepare($sql);
            $query -> execute(array($pseudo,$email));
            $line = $query -> fetch();

            if ($line == false) {

                if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])) {
                    include('divers/upload.php');
                    uploadImage("avatar");
                    $avatar = $_FILES['avatar']['name'];
                } 
                
                $remember = '';
                if (isset($_POST['remember'])) {
                    $hash = date("mdyHis") . $pseudo . $dn;
                    $remember = md5($hash);
                    setcookie('remember',$remember,time()+60*60*24*60);
                }
                
                $sql1 = "INSERT INTO user values(null, ?, PASSWORD(?), ?, ?, ?, ?, ?, '', 'Je suis nouveau sur Flow!')";
                $query1 = $pdo -> prepare($sql1);
                $query1 -> execute(array(htmlspecialchars($pseudo), $mdp1, $email,$remember,$avatar,$dn,'banniere-defaut.png'));
                $_SESSION['pseudo'] = htmlspecialchars($pseudo);
                $_SESSION['avatar'] = $avatar;
                $_SESSION['id'] = $pdo -> lastInsertId();

                $sql2 = "INSERT INTO reseaux values(?, '', '', '', '', '', '', '')";
                $query2 = $pdo -> prepare($sql2);
                $query2 -> execute(array($_SESSION['id']));
                
                $_SESSION['info'] = "Inscription réussi";
                header("Location: index.php?action=monCompte");
            }

            /*
            if ($line == false) {
                $sql1 = "INSERT INTO user values(null, ?, PASSWORD(?), ?, null, null)";
                $query1 = $pdo -> prepare($sql1);
                $query1 -> execute(array($_POST["login"], $_POST["mdp1"], $_POST['email']));
                $_SESSION["login"] = $_POST["login"];
                $_SESSION["id"] = $pdo -> lastInsertId();
                $_SESSION['info'] = "inscription réussie";
                header('Location: ../index.php?action=accueil');
            } */
            
            else {
                $_SESSION["erreur"] = "Pseudo ou email déjà utilisé";
                header("Location: index.php?action=inscription");
            }

        } 
        
        else {
            $_SESSION["erreur"] = "Les mots de passes sont différents.";
            header("Location: index.php?action=inscription");
        }

} else {

    $_SESSION["erreur"] = "L'une des données est manquante.";
    header("Location: index.php?action=inscription");

}

/*if ( !isset( $_POST["pseudo"] , $_POST['mdp1'], $_POST["mdp2"], $_POST['email'] )) {
    $_SESSION["erreur"] = "Données manquantes";

    header("Location: ../index.php?action=inscription");
} else {
    if ($_POST["mdp1"] != $_POST["mdp2"]) {
        $_SESSION["info"] = "mdp =/=";
        header('Location: ../index.php?action=creation');
    } else {
        $sql = "SELECT login FROM user WHERE login = ?";
        $query = $pdo->prepare($sql);
        $query -> execute(array($_POST["login"]));
        $line = $query -> fetch();
        if ($line == false) {
            $sql1 = "INSERT INTO user values(null, ?, PASSWORD(?), ?, null, null)";
            $query1 = $pdo -> prepare($sql1);
            $query1 -> execute(array($_POST["login"], $_POST["mdp1"], $_POST['email']));
            $_SESSION["login"] = $_POST["login"];
            $_SESSION["id"] = $pdo -> lastInsertId();
            $_SESSION['info'] = "inscription réussie";
            header('Location: ../index.php?action=accueil');
        } else {
            $_SESSION["info"] = "Login deja pris";
            header("Location: ../index.php?action=creation");
        }
    }
}*/

function valideDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

?>