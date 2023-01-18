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
        $postTitle = $_POST["postTitle"];
        $postContent = strval($_POST["postContent"]);
        $postUserId = $_SESSION["userId"];
        if($postsModel->isExist($postTitle, $postUserId, $postContent)) {
            echo "post exist";
        } else {
            include "upload_image.php";
            if(isset($_SESSION['postValider'])) {
                if($_SESSION['postValider']) {
                    $postCat = $_POST["Categories"];
                    $postAuthor = $_SESSION["user"];
                    $postImage = $_SESSION["imageName"];
                    $postsModel->setPost($postTitle, $postCat, $postImage, $postContent, $postAuthor,$postUserId);
                    
                } else {
                    echo "post n'est pas valide / image exist";
                }
            } else {
                echo "post n'est pas valide / image exist";
            }
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
                                $categorieModel->closeConnection();
                                $postsModel->closeConnection();
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    <?php include "footer.php" ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>