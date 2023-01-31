<?php 
    include "../../config.php";
    include $BlogPathInclude."model.php";
    $categoriesModel = new ModelCategories("categories");
    $postsModel = new ModelPosts("posts");
    $categories = $categoriesModel->getCategories();
    if(!isset($_SESSION["login"])) {
        header("location:".$BlogPathLien."index.php");
        exit();
    } else {
        if(isset($_SESSION['login']->role)) {
            if($_SESSION["login"]->role != "admin") {
                header("location:".$BlogPathLien."users/index.php");
                exit();
            } else {
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location:".$BlogPathLien."index.php");
                }
            
                if(isset($_POST["postTitle"], $_POST["Categories"], $_POST["postContent"])) {
                    include $BlogPathInclude."admin/upload_image.php";

                    $postTitle = $_POST["postTitle"];
                    $postContent = $_POST["postContent"];
                    $postCat = $_POST["Categories"];
                    $postAdminId = $_SESSION["login"]->id;
                    $postAuthor = $_SESSION["login"]->username;
                    $postImage = $_SESSION["imageName"];
                    echo $postImage;

                    if($_SESSION['imageValider']) {
                        $postCategoryId = $categoriesModel->getCategoryId($postCat);
                        $postsModel->setPost($postTitle, $postCat, $postImage, $postContent, $postAuthor,$postAdminId, $postCategoryId);
                        if(isset($_SESSION['post-partager'])) {
                            if($_SESSION["post-partager"]) {
                                echo "<script>
                                    alert('Post Partager !');
                                </script>";
                                unset($_SESSION["post-partager"]);
    
                                // header( "refresh: .3; url=".$BlogPathLien."admin/index.php" );
                                // exit();
                            } else {
                                echo "<script>
                                    alert('Post no partager / Exist déja !');
                                </script>";
                                unset($_SESSION["post-partager"]);
                            }
                        } 
                    } else {
                        echo "<script>
                            alert('Post no partager / error-image !');
                        </script>";
                        unset($_SESSION["imageValider"]);
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="fr-FR">
    <?php include $BlogPathInclude."head.php" ?>
<body id="body" class="post-categorie">
    <?php include $BlogPathInclude."header.php" ?>
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
                                <?php if(!empty($categories)) :?>
                                    <?php for($i=0; isset($categories[$i]); $i++) :?>
                                        <option value='<?= htmlspecialchars($categories[$i]["categoryName"]) ?>'><?= htmlspecialchars($categories[$i]["categoryName"]) ?></option>
                                    <?php endfor ?>
                                <?php endif ?>
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
                            if(!empty($categories)) :?>
                                <?php for($i=0; isset($categories[$i]); $i++) {
                                    echo "
                                    <li><a href='posts_categories.php?id=".$categories[$i]['id']."'><span><i class='fa-sharp fa-solid fa-tags'></i>".htmlspecialchars($categories[$i]['categoryName'])."</span></a></li>
                                    ";
                                }?>
                            <?php else :?>
                                <p>aucune categorie existe !</p>
                            <?php endif ?>
                        </ul>
                    </div>
                    <div class="row last-posts flex-c">
                        <h2>dernier posts</h2>
                        <ul class="flex-c">
                        <?php
                        $posts = $postsModel->getLastPosts();
                        if($posts) :?>
                            <?php for($i=0; isset($posts[$i])&&$i <3 ; $i++) : ?>
                                <li class='last-post'>
                                    <a href='post_page.php?id=<?php echo $posts[$i]['id'] ?>' class='last-post'>
                                        <span class='img-last-post'><img src='<?php echo $BlogPathLien?>assets/img/posts_images/<?php echo $posts[$i]['postImage'] ?>' alt='<?php echo $posts[$i]['postImage'] ?>'></span>
                                        <span><?php echo htmlspecialchars($posts[$i]['postTitle']) ?></span>
                                    </a>
                                </li>
                            <?php endfor ;?>
                        <?php else :?>
                            <p>aucune Postes publier !</p>
                        <?php endif ?>
                        </ul>
                        <?php
                            // On ferme la connexion
                            $categoriesModel->closeConnection();
                            $postsModel->closeConnection();
                        ?>
                    </div>
                </div>
            </div>
        </main>
    <?php
        include $BlogPathInclude."footer.php";
    ?>
    <script src="<?php echo $BlogPathLien?>/assets/js/script.js"></script>
</body>
</html>