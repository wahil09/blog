<?php 
    session_start();
    include "../model.php";
    $categories = new ModelCategories();
    $posts = new ModelPosts();
    if(!isset($_SESSION["user"])) {
        header("location: ../index.php");
    }

    if(isset($_GET["logout"])) {
        session_destroy();
        header("location: ../index.php");
    }

    if(isset($_POST["postTitle"], $_POST["Categories"], $_POST["postContent"])) {
        $postTitle = $_POST["postTitle"];
        $postContent = $_POST["postContent"];
        $postUserId = $_SESSION["userId"];
        if($posts->isExist($postTitle, $postUserId, $postContent)) {
            echo "post exist";
        } else {
            include "upload_image.php";
            if(isset($_SESSION['postValider'])) {
                if($_SESSION['postValider']) {
                    $postCat = $_SESSION["Categories"];
                    $postAuthor = $_SESSION["user"];
                    $postImage = $_SESSION["imageName"];
                    $posts->setPost($postTitle, $postCat, $postImage, $postContent, $postAuthor,$postUserId);
                } else {
                    echo "post n'est pas valide / image exist";
                }
            } else {
                echo "post n'est pas valide / image exist";
            }
        }
    }
    unset($_SESSION["postValider"], );
    
    // if(isset($_SESSION["postValider"])) {
    //     if($_SESSION["postValider"]) {
    //         $postTitle = $_SESSION["postTitle"];
    //         $postCat = $_SESSION["Categories"];
    //         $postContent = $_SESSION["postContent"];
    //         $postAuthor = $_SESSION["user"];
    //         $postUserId = $_SESSION["userId"];
    //         $posts->setPost($postTitle, $postCat, $postContent, $postAuthor, $postUserId);
    //     } else {
    //         echo 'post n"est pas ajouter';
    //     }
    //     unset($_SESSION["postValider"]);
    // }

    // if(isset($_SESSION["postExist"])) {
    //     echo "Post exist";
    // }

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
                                    for($i=0; isset($categories->getCategories()[$i]); $i++) {
                                        foreach($categories->getCategories()[$i] as $value) {
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
                    <div class="row last-posts flex-c">
                        <h2>dernier posts</h2>
                        <ul class="flex-c">
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-1.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-2.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-3.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    <?php include "footer.php" ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>