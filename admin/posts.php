<?php 
    include "../model.php";
    $categoriesModel = new ModelCategories();
    $postsModel = new ModelPosts();
    $posts = $postsModel->getPosts();
    if(!isset($_SESSION["login"])) {
        header("location: ../index.php");
        exit();
    } else {
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION['login']->role != "admin") {
                header("location: ../users/");
                exit();
            } else {
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location: ../index.php");
                    exit();
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
<?php require_once("head.php")?>
<body>
    <div class="content">
        <?php require_once("header.php")?>
        <main class="container-panel">
            <?php require_once("side-bare.php")?>
            <section class="box-content-panel">
                <div class="content-panel">
                    <ul>
                        <li><a href="new_post.php" class="btn-panel">add post</a></li>
                        <li><a href="#" class="btn-panel">manage posts</a></li>
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
                                        <td><?= $posts[$i]['postTitle'] ?></td>
                                        <td><?= $posts[$i]['postAuthor'] ?></td>
                                        <td class="action-content">
                                        <ul class="flex-r">
                                            <li><a href="" class="first-action">edit</a></li>
                                            <li><a href="" class="second-action">delete</a></li>
                                            <li><a href="" class="last-action">publish</a></li>
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
    <script src="assets/js/script.js"></script>
</body>
</html>