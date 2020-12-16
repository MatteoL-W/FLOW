<?php



if (isset($_POST['valider'], $_POST['email'], $_POST['pseudo'], $_POST['age'])
    && (!empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['age'])) 
    && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    && valideDate($_POST['age'], 'Y-m-d')) {
    
    $sql1 = "UPDATE user, reseaux
             SET user.login = ?,
             user.email = ?,
             user.date_naissance = ?,
             user.interets = ?,
             user.biographie = ?,

             reseaux.soundcloud = ?,
             reseaux.youtube = ?,
             reseaux.behance = ?,
             reseaux.instagram = ?,
             reseaux.twitter = ?,
             reseaux.facebook = ?,
             reseaux.pinterest = ?

             WHERE user.id = ? AND reseaux.idUser = ?";
             
    $query1 = $pdo -> prepare($sql1);
    $query1 -> execute(array(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['email']),$_POST['age'],htmlspecialchars($_POST['interets']),htmlspecialchars($_POST['biographie']),htmlspecialchars($_POST['soundcloud']),htmlspecialchars($_POST['youtube']),htmlspecialchars($_POST['behance']),htmlspecialchars($_POST['instagram']),htmlspecialchars($_POST['twitter']),htmlspecialchars($_POST['facebook']),htmlspecialchars($_POST['pinterest']),$_SESSION['id'],$_SESSION['id']));


    $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
    $_SESSION['info'] = 'Modification prise en compte';

    header('Location: index.php?action=monCompte');
    
} else {
    $_SESSION['erreur'] = 'Merci de remplir les champs correctement';
    header('Location: index.php?action=monCompte');
}

function valideDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
?>