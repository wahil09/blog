<?php
    //ini_set("log_errors", 1); // Enable error logging
    //ini_set("error_log", "/tmp/php-error.log"); // set error path
    //error_log( "Hello, errors!" ); // log a test error
    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
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
        $_SESSION['postValider'] = false;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["imageToUpload"]["name"]) . " has been uploaded.";
            $_SESSION["imageName"] = $_FILES["imageToUpload"]["name"];
            $_SESSION['postValider'] = true;

        } else {
            $_SESSION['postValider'] = false;
            // echo "Sorry, there was an error uploading your file.";
        }
    }
?>