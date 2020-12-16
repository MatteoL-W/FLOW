<?php
function uploadImage($av) {
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES[$av]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if(isset($_POST["valider"])) {
    $check = getimagesize($_FILES[$av]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $_SESSION['erreur'] = "Le document n'est pas une image";
      $uploadOk = 0;
    }
  }

  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $_SESSION['erreur'] = "Seuls les images jpg, jpeg et png sont autorisées.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES[$av]["tmp_name"], $target_file)) {
      $uploadOk = 1;
      $_SESSION['info'] = "L'image est enregistré.";
    } else {
      $_SESSION['erreur'] = "Echec d'enregistrement de l'image.";
      $uploadOk = 0;
    }
  }
}
// Check if image file is a actual image or fake image
function uploadSound($av) {
  $target_dir = "upload/";
  $basename = basename($_FILES[$av]["name"]);
  $basename = preg_replace("/[^a-z0-9\.]/", "", strtolower($basename));
  $target_file = $target_dir . $basename;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Allow certain file formats
  if($imageFileType != "mp3" && $imageFileType != "wav") {
    $_SESSION['erreur'] = "Seuls les sons sont autorisées.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES[$av]["tmp_name"], $target_file)) {
      $uploadOk = 1;
      $_SESSION['info'] = "Le son est enregistré.";
    } else {
      $_SESSION['erreur'] = "Echec d'enregistrement du son.";
      $uploadOk = 0;
    }
  }
}