<?php

$id = $_GET['id'];
$referer = $_SERVER['HTTP_REFERER'];

if (isset($_POST['valider'], $_POST['post-profil']) && !empty($_POST['post-profil'])) {

    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
        include('divers/upload.php');
        uploadImage("image");
        $image = $_FILES['image']['name'];
    } 
    
    else if (isset($_FILES['son']['name']) && !empty($_FILES['son']['name'])) {
        include('divers/upload.php');
        uploadSound("son");
        $image = $_FILES['son']['name'];
        $image = preg_replace("/[^a-z0-9\.]/", "", strtolower($image));
    } 
    
    else {
        $image = '';
    }

    
    

    $sql = "INSERT INTO ecrit values(null, ?, ?, ?, ?, ?)";
    $query = $pdo -> prepare($sql);
    $query -> execute(array(htmlspecialchars($_POST['post-profil']), date("Y-m-d H:i:s"), $image, $_SESSION['id'], $_GET['id']));

    $_SESSION['info'] = "Le post a été crée";
    header("Location: $referer");
} else {
    $_SESSION["erreur"]= "Merci de rentrer un message.";
    header("Location: $referer");
}

?>