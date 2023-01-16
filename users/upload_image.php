<?php
    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        echo "bvb";
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        echo $check;
        if($check !== false) {
            echo "File is an image - " . $check['mime'] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image !";
            $uploadOk = 0;
        }
    }
    header('location : new_post.php');
?>