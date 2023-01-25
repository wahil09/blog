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

?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
<body id="body" class="post-categorie">
    <?php include "header.php" ?>
    <main class="content">
            <div class="container">
                <section class='posts'>
                    <h2 class="title">Articles :</h2>
                    <?php 
                    $posts = $postsModel->getMyPosts();
                    for($i=0; isset($posts[$i]); $i++) : ?>
                        <article class='post'>
                            <div class='post-image'>
                                <img src='assets/img/<?php echo $posts[$i]['postImage'] ?>' alt='<?php echo $posts[$i]['postImage'] ?>'>
                            </div>
                            <div class='post-title'>
                                <h3><?php echo $posts[$i]['postTitle'] ?></h3>
                            </div>
                            <div class='post-details'>
                                <p class='post-info'>
                                    <span><i class='fa-solid fa-user'></i><?php echo $posts[$i]['postAuthor'] ?></span>
                                    <span><i class='fa-solid fa-calendar-days'></i><?php echo $posts[$i]['postDate'] ?></span>
                                    <span><i class='fa-sharp fa-solid fa-tags'></i><?php echo $posts[$i]['postCat'] ?></span>
                                </p>
                                <p class='post-description'><?php echo substr($posts[$i]['postContent'], 0, 300) ?> ...</p>
                                <a href='post_page.php?id=<?php echo $posts[$i]['id'] ?>' class='btn-custom' >Lire Plus</a>
                            </div>
                        </article>
                    <?php endfor; ?>
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
                                for($i=0; isset($posts[$i])&&$i<3; $i++) : ?>
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
        include "../footer.php";
    ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>