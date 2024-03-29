<?php 
    require_once("../../inc/config.php");
    require_once($BlogPathInclude."inc/model.php");
    $categoriesModel = new ModelCategories();
    $postsModel = new ModelPosts();
    $posts = $postsModel->getPosts();

    if(!isset($_SESSION["login"])) {
        header("location:".$BlogPathLien."index.php");
        exit();
    } else {
        if($_SESSION['login']->role != "admin") {
            header("location: ".$BlogPathLien."users/index.php");
            exit();
        }
    }
    
    // pour la déconnexion
    if(isset($_GET["logout"])) {
        require_once($BlogPathInclude."inc/logout.php");
    }

    // delete post
    if(isset($_GET["delete"])) {
        $postId = $_GET["delete"];
        // vérifier s'il n'est pas supprimer déja 
        $postsDeleted = $postsModel->checkIfExistById($postId, "posts");
        if(!empty($postsDeleted)) {
            // supprimer le post
            $postsModel->deleteById($postId, $postsModel->getTableName());
            echo "<script>
                alert('le post est bien supprimer !');
            </script>";
            // check if image existe in posts_images directory
            if(file_exists($PathImagesPosts . $postsDeleted->postImge)) {
                // supprimer l'image de post supprimer
                unlink($PathImagesPosts . $postsDeleted->postImage);
            } else {
                // l'image n'existe plus / on le supprime pas elle est déja supprimer
            }
            header("location:".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>
                alert('post Déja supprimer / n'éxiste plus');
            </script>";
        }
    }

    // publish post 
    if(isset($_GET["publish"])) {
        $postId = $_GET["publish"];
        $postContent = $postsModel->checkIfExistById($postId, "posts");
        // vérifier si le post existe
        if(!empty($postContent)) {
            // vérifier si le post est déja publier
            $postsNoPublished = $postsModel->checkIfPostPublishedById($postId);
            if($postsNoPublished) {
                $postsModel->publishPostById($postId);
                echo "<script>
                    alert('le post est bien publier !');
                </script>";
                header("refresh:.1; url=".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<script>
                    alert('post est déja publier !');
                </script>";
                header("refresh:.1; url=".$_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            echo '<script>
                alert("post est supprimer / n\'éxiste plus");
            </script>';
            header("refresh:.1; url=".$_SERVER['PHP_SELF']);
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php require_once($adminPathInclude."inc/head.php")?>
    <body>
        <div class="content">
            <?php require_once($adminPathInclude."inc/header.php")?>
            <main class="container-panel">
                <?php require_once($adminPathInclude."inc/side-bare.php")?>
                <section class="box-content-panel">
                    <div class="content-panel">
                        <ul>
                            <li><a href="new_post.php" class="btn-panel">add post</a></li>
                            <li><a href="manage_posts.php" class="btn-panel">manage posts</a></li>
                        </ul>
                        <div class="clear"></div>
                        <h2 class="title-panel-page">manage posts</h2> 
                        <?php if(!empty($posts)) :?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>title</th>
                                        <th>author</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i=0; isset($posts[$i]); $i++) :?>
                                        <tr>
                                            <td><?= $posts[$i]['id'] ?></td>
                                            <td class="post-title"><?= htmlspecialchars($posts[$i]['postTitle']) ?></td>
                                            <td><?= htmlspecialchars($posts[$i]['postAuthor']) ?></td>
                                            <td class="action-content">
                                            <ul class="flex-r">
                                                <li><a href="" class="first-action">edit</a></li>
                                                <li><a href="?delete=<?php echo $posts[$i]['id']?>&&imgName=<?php echo $posts[$i]['postImage']?>" class="second-action">delete</a></li>
                                                <?php if($posts[$i]['published'] == 0) :?>
                                                    <li><a href="?publish=<?php echo $posts[$i]['id']?>" class="last-action">publish</a></li>
                                                <?php endif?>
                                            </ul>
                                        </td>
                                        </tr>
                                    <?php endfor ?>
                                </tbody>
                            </table>
                        <?php else :?>
                            <p>Aucune post publier !</p>
                        <?php endif ?>
                    </div>
                </section>
            </main>
        </div>
        <?php
            // On ferme la connexion
            $categoriesModel->closeConnection();
            $postsModel->closeConnection();
        ?>
    </body>
</html>