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
  
  // Check if file already exists
  if (file_exists($target_file)) {
    $_SESSION['erreur'] = "Le document existe déjà";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES[$av]["size"] > 500000) {
    $_SESSION['erreur'] = "Votre image est trop volumineuse";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $_SESSION['erreur'] = "Seuls les images jpg, jpeg et png sont autorisées.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $_SESSION['erreur'] = "L'image n'a pas été uploadé.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES[$av]["tmp_name"], $target_file)) {
      $_SESSION['info'] = "L'image est enregistré.";
    } else {
      $_SESSION['erreur'] = "L'image n'a pas été uploadé.";
    }
  }
}
// Check if image file is a actual image or fake image

?>