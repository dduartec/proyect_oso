<?php

  // Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {

    $target_dir = "uploads/";
    $uploadOk = 1;
    $file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    #echo ($imageFileType . "<br/>");

    $newName = $_POST["image_id"]."." . $imageFileType;
    $target_file = $target_dir . $newName;


     // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size se revisa si es mayor a 500KB
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

  // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "pdf") {
        echo "Sorry, only JPG, JPEG, PNG, GIF and PDF files are allowed.";
        $uploadOk = 0;
    }

  // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo '
    <form action="upload.php" method="post" enctype="multipart/form-data">
    enter image id:
    <input type="text" name="image_id" id="image_id">
    <br/>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
  </form>
  ';

}


?>
