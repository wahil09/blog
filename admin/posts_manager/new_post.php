<?php 
    include "../../config.php";
    include $BlogPathInclude."model.php";
    $categoriesModel = new ModelCategories();
    $postsModel = new ModelPosts();
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
                
                if(isset($_POST["save"])) {
                    if(isset($_POST["postTitle"], $_POST["Categories"], $_POST["postContent"], $_FILES["imageToUpload"])) {
                        if(!empty($_POST["postTitle"]) && !empty($_POST["Categories"]) && !empty($_POST["postContent"]) && $_FILES["imageToUpload"]["size"] != 0) {
                            include $adminPathInclude."inc/upload_image.php";
    
                            $postTitle = $_POST["postTitle"];
                            $postContent = $_POST["postContent"];
                            $postCat = $_POST["Categories"];
                            $postAdminId = $_SESSION["login"]->id;
                            $postAuthor = $_SESSION["login"]->username;
                            $postImage = $_SESSION["imageName"]; // viens de file upload_image.php
        
                            if($_SESSION['imageValider']) { // viens de file upload_image.php
                                $postCategoryId = $categoriesModel->getCategoryId($postCat);
                                $postsModel->savePost($postTitle, $postCat, $postImage, $postContent, $postAuthor,$postAdminId, $postCategoryId);
                                if(isset($_SESSION['post_saved'])) {
                                    if($_SESSION["post_saved"]) {
                                        echo "<script>
                                            alert('Post Enregistrer !');
                                        </script>";
                                        unset($_SESSION["post_saved"]);
                                        header( "refresh: .3; url=".$adminPathLien."posts_manager/manage_posts.php" );
                                        exit();
                                    } else {
                                        // pour supprimer l'image télécharger 
                                        unlink($target_file);
                                        echo "<script>
                                            alert('Post no partager / Exist déja !');
                                        </script>";
                                        unset($_SESSION["post_saved"]);
                                    }
                                } 
                            } else {
                                echo "<script>
                                    alert('Post n'a pas enregistrer / error-image !');
                                </script>";
                                unset($_SESSION["imageValider"]);
                            }
                        } else {
                            $_SESSION['champ-vide'] = true;
                            header("location:". $_SERVER["PHP_SELF"]);
                            exit();
                        }
                    }
                }
            }
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
                        <h2 class="title-panel-page">create post</h2> 

                        <form enctype="multipart/form-data" method="post" class="flex-c form-new-post">
                            <label for="title">Article name : </label>
                            <input type="text" name="postTitle" id="title" class="inp-style" value='<?php echo isset($_POST["postTitle"]) ? $_POST["postTitle"] : "" ?>' >
                            
                            <label for="Categories">Categories : </label>
                            <select name="Categories" id="Categories" class="inp-style">
                                <option value="">Choisir un categorie ...</option>
                                <?php if(!empty($categories)) :?>
                                    <?php for($i=0; isset($categories[$i]); $i++) :?>
                                        <option 
                                        value='<?= htmlspecialchars($categories[$i]["categoryName"]) ?>'

                                        <?php echo isset($_POST['Categories']) && $_POST['Categories'] == htmlspecialchars($categories[$i]['categoryName']) ? 'selected' : ""?>><?= htmlspecialchars($categories[$i]["categoryName"])
                                        ?>
                                    </option>
                                    <?php endfor ?>
                                <?php endif ?>
                            </select>

                            <label for="imageToUpload">Article image : </label>
                            <input type="file" name="imageToUpload" id="imageToUpload" class="inp-style" accept="image/*" >

                            <textarea name="postContent" id="post-text" class="inp-style" cols="90" rows="10"><?php echo isset($_POST['postContent']) ? $_POST['postContent'] : ""?></textarea>
                            <?php 
                                if(isset($_SESSION['champ-vide'])) {
                                    echo '<p class="error-msg">un champ ou plusieur champs de formulaire sont vide !</p>';
                                }
                                unset($_SESSION['champ-vide']);
                            ?>
                                

                            <input type="submit" value="save" name="save" class="btn-panel">
                        </form>
                    </section>

                    <?php
                        // On ferme la connexion
                        $categoriesModel->closeConnection();
                        $postsModel->closeConnection();
                    ?>
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