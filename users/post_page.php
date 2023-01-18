<?php 
    session_start();
    include "../model.php";
    $categoriesModel = new ModelCategories();
    $postsModel = new ModelPosts();
    if(!isset($_SESSION["user"])) {
        header("location: ../login.php");
    }

    if(isset($_GET["logout"])) {
        session_destroy();
        header("location: ../index.php");
    }

    if(isset($_SESSION["postExist"])) {
        header("location: new_post.php");
    }

    $post = [];
    if(isset($_GET["id"])) {
        $postId = $_GET["id"];
        $post = $postsModel->getPostSelected($postId);
    }
    
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
<body id="body" class="post-categorie">
    <?php include "header.php" ?>
    <main class="content">
            <div class="container">
                <section class='posts'>
                    <article class='post'>
                        <div class='post-image'>
                            <img src='assets/img/<?php echo $post['postImage'] ?>' alt=''>
                        </div>
                        <div class='post-title'>
                            <h3><?php echo $post['postTitle'] ?></h3>
                        </div>
                        <div class='post-details'>
                            <p class='post-info'>
                                <span><i class='fa-solid fa-user'></i><?php echo $post['postAuthor'] ?></span>
                                <span><i class='fa-solid fa-calendar-days'></i><?php echo $post['postDate'] ?></span>
                                <span><i class='fa-sharp fa-solid fa-tags'></i><?php echo $post['postCat'] ?></span>
                            </p>
                            <p class='post-description'><?php echo $post['postContent'] ?></p>
                            <a href="#" class='btn-custom'>Lire Plus</a>
                        </div>
                    </article>
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
                                for($i=0; isset($posts[$i]); $i++) : ?>
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