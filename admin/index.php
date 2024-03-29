<?php 
    include "../inc/config.php";
    include $BlogPathInclude."inc/model.php";
    $categoriesModel = new ModelCategories();
    $postsModel = new ModelPosts();

    if(!isset($_SESSION["login"])) {
        header("location:".$BlogPathLien."index.php");
        exit();
    } else {
        if($_SESSION['login']->role != "admin") {
            header("location: ".$BlogPathLien."users/index.php");
            exit();
        }
    }
    
    if(isset($_GET["logout"])) {
        require_once($BlogPathInclude."inc/logout.php");
    }
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <?php include $BlogPathInclude."inc/head.php" ?>
<body id="body" class="post-categorie">
    <?php include $BlogPathInclude."inc/header.php" ?>
    <main class="content">
        <div class="container">
            <section class='posts'>
                <h2 class="title">Articles :</h2>
                <?php 
                $posts = $postsModel->getPostsPublished();
                if(!empty($posts)) : ?>
                    <?php for($i=0; isset($posts[$i]); $i++) : ?>
                        <article class='post'>
                            <div class='post-image'>
                                <img src='<?php echo $BlogPathLien?>assets/img/posts_images/<?php echo $posts[$i]['postImage'] ?>' alt='<?php echo $posts[$i]['postImage'] ?>'>
                            </div>
                            <div class='post-title'>
                                <h3><?php echo $posts[$i]['postTitle'] ?></h3>
                            </div>
                            <div class='post-details'>
                                <p class='post-info'>
                                    <span><i class='fa-solid fa-user'></i><?php echo htmlspecialchars($posts[$i]['username']) ?></span>
                                    <span><i class='fa-solid fa-calendar-days'></i><?php echo htmlspecialchars($posts[$i]['postDate']) ?></span>
                                    <span><i class='fa-sharp fa-solid fa-tags'></i><?php echo $posts[$i]['postCat'] ?></span>
                                </p>
                                <p class='post-description'><?php echo htmlspecialchars(substr($posts[$i]['postContent'], 0, 300)) ?> ...</p>
                                <a href='<?php echo $adminPathLien?>inc/post_page.php?id=<?php echo htmlspecialchars($posts[$i]['id']) ?>' class='btn-custom' >Lire Plus</a>
                            </div>
                        </article>
                    <?php endfor; ?>
                <?php else : ?>
                    <p>aucune Postes publier !</p>
                <?php endif ?>
            </section>

            <div class="sidebar">
                <div class="row categories flex-c">
                    <h2>Categories</h2>
                    <ul class="flex-c">
                        <?php 
                        $categories = $categoriesModel->getCategories();
                        if(!empty($categories)) :?>
                            <?php for($i=0; isset($categories[$i]); $i++) :?>
                                <li>
                                    <a href='<?php echo $adminPathLien?>inc/posts_categories.php?id="<?php echo $categories[$i]['id']?>'>
                                    <span><i class='fa-sharp fa-solid fa-tags'></i><?php echo htmlspecialchars($categories[$i]['categoryName'])?></span>
                                </a>
                                </li>
                            <?php endfor?>
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
                                    <a href='<?php echo $adminPathLien?>inc/post_page.php?id=<?php echo $posts[$i]['id'] ?>' class='last-post'>
                                        <span class='img-last-post'><img src='<?php echo $BlogPathLien?>assets/img/posts_images/<?php echo $posts[$i]['postImage'] ?>' alt='<?php echo $posts[$i]['postImage'] ?>'></span>
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
        include $BlogPathInclude."inc/footer.php";
    ?>
    <script src="<?php echo $BlogPathLien?>assets/js/script.js"></script>
</body>
</html>