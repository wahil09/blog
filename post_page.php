<?php 
    session_start();
    include "model.php";
    $categoriesModel = new ModelCategories();
    $postsModel = new ModelPosts();
    $categories = $categoriesModel->getCategories();
    
    if(isset($_SESSION["login"])) {
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION["login"]->role == "user") {
                header("location: users");
                exit();
            } else {
                header("location: admin");
                exit();
            }
        }
    }

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
                        <?php if(!empty($post)) :?>
                            <div class='post-image'>
                                <img src='assets/img/posts_images/<?php echo $post['postImage'] ?>' alt=''>
                            </div>
                            <div class='post-title'>
                                <h3><?php echo htmlspecialchars($post['postTitle']) ?></h3>
                            </div>
                            <div class='post-details'>
                                <p class='post-info'>
                                    <span><i class='fa-solid fa-user'></i><?php echo htmlspecialchars($post['postAuthor']) ?></span>
                                    <span><i class='fa-solid fa-calendar-days'></i><?php echo htmlspecialchars($post['postDate']) ?></span>
                                    <span><i class='fa-sharp fa-solid fa-tags'></i><?php echo htmlspecialchars($post['postCat']) ?></span>
                                </p>
                                <p class='post-description'><?php echo htmlspecialchars($post['postContent']) ?></p>
                                <a href="index.php" class='btn-custom'>Acceuil</a>
                            </div>
                        <?php else :?>
                            <h3>Post supprimer</h3>
                        <?php endif ?>
                    </article>
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
                            $posts = $postsModel->getLastPosts();;
                            if($posts) : ?>
                                <?php for($i=0; isset($posts[$i])&&$i<3; $i++) : ?>
                                    <li class='last-post'>
                                        <a href='post_page.php?id=<?php echo $posts[$i]['id'] ?>' class='last-post'>
                                            <span class='img-last-post'><img src='assets/img/posts_images/<?php echo $posts[$i]['postImage'] ?>' alt='<?php echo $posts[$i]['postImage'] ?>'></span>
                                            <span><?php echo htmlspecialchars($posts[$i]['postTitle']) ?></span>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            <?php else : ?>
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
        include "footer.php";
    ?>
    <script src="assets/js/script.js"></script>
    
</body>
</html>