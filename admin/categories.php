<?php 
    session_start();
    include "../model.php";
    $categoriesModel = new ModelCategories();

    if(!isset($_SESSION["login"])) {
        header("location: ../index.php");
        exit();
    } else {
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION["login"]->role != "admin") {
                header("location: ../users/index.php");
                exit();
            } else {
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location: ../index.php");
                    exit();
                }
        
                if (isset($_SESSION["category_ajouter"])) {
                    $category_ajouter = $_SESSION["category_ajouter"];
                    echo "<script>
                            alert('$category_ajouter est bien ajouter !');
                        </script>";
                    unset($_SESSION['category_ajouter']);
                    // header("location: new_post.php");
                    header('refresh: 0.5; URL=new_post.php');
                    exit();
                };
            
                if(isset($_SESSION["category_exist"])) {
                    $category_exist = $_SESSION["category_exist"];
                    echo "<script>
                        alert('Désoli! ce categorie: \"$category_exist\" est déja Ajouter ? !');
                    </script>";
                    unset($_SESSION["category_exist"]);
                }
            
                if(isset($_POST["category"])) {
                    $category_name = $_POST["category"];
                    $categoriesModel->setCategories($category_name, $_SESSION["login"]->id);
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "../head.php" ?>
    <body id="body" class="post-categorie">
        <?php include "../header.php" ?>
        <main class="content">
            <div class="container">
                <form method="post" class="form-categorie">
                    <label for="category">New Category :</label>
                    <input type="text" name="category" id="category" required>
                    <input type="submit" value="Ajouter">
                </form>
                <div class="sidebar">
                    <div class="row categories flex-c">
                        <h2>Categories</h2>
                        <ul class="flex-c">
                            <?php 
                            $categories = $categoriesModel->getCategories();
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
                </div>
            </div>
        </main>
        <?php
            include "../footer.php";
            // On ferme la connexion
            $categoriesModel->closeConnection();
        ?>
        <script src="../assets/js/script.js"></script>
    </body>
</html>