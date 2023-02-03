<?php
    require_once("../../inc/config.php");

    // redirect l'admin sur la page index s'il entre sur cette page pas par new_post 
    if(!isset($_FILES["imageToUpload"])) {
        header("location: ".$adminPathLien);
        exit();
    }

    //ini_set("log_errors", 1); // Enable error logging
    //ini_set("error_log", "/tmp/php-error.log"); // set error path
    //error_log( "Hello, errors!" ); // log a test error
    $target_dir = $BlogPathInclude."assets/img/posts_images/";

    // j'utilise current time pour différencier entre les noms des images
    $date = date('d-m-Y-h-i-s-');
    $fileName = $date .basename( $_FILES["imageToUpload"]["name"]);
    
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        echo "<script>
            alert('File is not an image.!');
        </script>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        echo "<script>
            alert('Sorry, file already exists.');
        </script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["imageToUpload"]["size"] > 500000) {
        // echo "Sorry, your file is too large.";
        echo "<script>
            alert('Sorry, your file is too large..');
        </script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        echo "<script>
            alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
        </script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        $_SESSION['imageValider'] = false;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["imageToUpload"]["name"]) . " has been uploaded.";
            $_SESSION["imageName"] = $fileName;
            $_SESSION['imageValider'] = true;

        } else {
            $_SESSION['imageValider'] = false;
            // echo "Sorry, there was an error uploading your file.";
        }
    }
?>