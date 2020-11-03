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

include("../config/bd.php"); // commentaire

if ( !isset( $_POST["login"] , $_POST['mdp1'], $_POST["mdp2"], $_POST['email'] )) {
    $_SESSION["info"] = "Donnes manquantes";
    header('Location: ../index.php?action=creation');
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
}

?>