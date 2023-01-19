<?php 
    session_start();
    include "../model.php";
    $categoriesModel = new ModelCategories();
    $postsModel = new ModelPosts();
    if(!isset($_SESSION["user"])) {
        header("location: ../index.php");
    }

    if(isset($_GET["logout"])) {
        session_destroy();
        header("location: ../index.php");
    }

    if(isset($_POST["postTitle"], $_POST["Categories"], $_POST["postContent"])) {
        include "upload_image.php";
        $postTitle = $_POST["postTitle"];
        $postContent = $_POST["postContent"];
        $postCat = $_POST["Categories"];
        $postImage = $_SESSION["imageName"] = $_FILES["imageToUpload"]["name"];
        $postUserId = $_SESSION["userId"];
        $postAuthor = $_SESSION["user"];

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            echo "<script>
                alert('Sorry, your file was not uploaded.');
            </script>";
            $_SESSION['imageIsUpload'] = false;
            $_SESSION["post-partager"] = 'image-exist';

        // if everything is ok, try to upload file
        } else {
            $postsModel->setPost($postTitle, $postCat, $postImage, $postContent, $postAuthor,$postUserId);
            if(isset($_SESSION['post-partager'])) {
                if($_SESSION['post-partager'] == "exist") {
                    if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
                        //echo "The file " . basename($_FILES["imageToUpload"]["name"]) . " has been uploaded.";
                        $_SESSION['imageIsUpload'] = true;
                        
                    } else {
                        $_SESSION["post-partager"] = 'image-error';
                        echo "<script>
                            alert('Sorry, your file was not uploaded1.');
                        </script>";
                        $_SESSION['imageIsUpload'] = false;
                        // echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        } 
    }
    if(isset($_SESSION['post-partager'])) {
        if($_SESSION["post-partager"] == "exist") {
            echo "<script>
                alert('Post no partager / Exist déja !');
            </script>";
            unset($_SESSION["post-partager"]);
            unset($_SESSION["imageIsUpload"]);
            
        } elseif($_SESSION["post-partager"] == "image-exist") {
            // echo "<script>
            //     alert('Post Partager !');
            // </script>";
            // unset($_SESSION["post-partager"]);

        }
    }
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
<body id="body" class="post-categorie">
    <?php include "header.php" ?>
    <main class="content">
            <div class="container">
                <section class='new-post'>
                    <h2>Nouveau Article :</h2>
                    <form enctype="multipart/form-data" method="post" class="flex-c form-new-post">
                        <div class="inp-box">
                            <label for="title">Article name : </label>
                            <input type="text" name="postTitle" id="title" required>
                        </div>
                        <div class="inp-box">
                            <label for="Categories">Categories : </label>
                            <select name="Categories" id="Categories" required>
                                <option value="">Choisir un categorie ...</option>
                                <?php
                                    for($i=0; isset($categoriesModel->getCategories()[$i]); $i++) {
                                        foreach($categoriesModel->getCategories()[$i] as $value) {
                                            echo "
                                            <option value='$value'>$value</option>
                                            ";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="inp-box">
                            <label for="imageToUpload">Article image : </label>
                            <input type="file" name="imageToUpload" id="imageToUpload" required>
                        </div>
                        <div class="inp-box">
                            <textarea name="postContent" id="post-text" cols="90" rows="10" required></textarea>
                        </div>
                        <div class="inp-box">
                            <input type="submit" value="upload">
                        </div>
                    </form>
                </section>

                <div class="sidebar">
                    <div class="row categories flex-c">
                        <h2>Categories</h2>
                        <ul class="flex-c">
                            <?php 
                            $categories = $categoriesModel->getCategories();
                                for($i=0; isset($categories[$i]); $i++) {
                                    foreach($categories[$i] as $value) {
                                        echo "
                                        <li><a href='#'><span><i class='fa-sharp fa-solid fa-tags'></i>$value</span></a></li>
                                        ";
                                    }
                                }
                            ?>
                        </ul>
                        <p id="paraEmptyCategories" class=''>aucune categorie existe !</p>
                    </div>
                    <div class="row last-posts flex-c">
                        <h2>dernier posts</h2>
                        <ul class="flex-c">
                        <?php
                            $posts = $postsModel->getPosts();;
                            for($i=0; isset($posts[$i])&&$i <3 ; $i++) : ?>
                                <li class='last-post'>
                                    <a href='post_page.php?id=<?php echo $posts[$i]['id'] ?>' class='last-post'>
                                        <span class='img-last-post'><img src='assets/img/<?php echo $posts[$i]['postImage'] ?>' alt='<?php echo $posts[$i]['postImage'] ?>'></span>
                                        <span><?php echo $posts[$i]['postTitle'] ?></span>
                                    </a>
                                </li>
                            <?php
                                endfor; 
                                // On ferme la connexion
                                $categoriesModel->closeConnection();
                                $postsModel->closeConnection();
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    <?php
        include "footer.php";
        include "../aff_tableau_vide.php";
    ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>