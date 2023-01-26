<?php 
    session_start();
    include "../model.php";
    $categoriesModel = new ModelCategories();

    if(!isset($_SESSION["user"], $_SESSION["role"])) {
        header("location: ../index.php");
        exit();
    } else {
        if($_SESSION["user"] != "admin") {
            header("location: ../users/index.php");
            exit();
        }

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
            $categoriesModel->setCategories($category_name, $_SESSION["adminId"]);
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
                                    foreach($categories[$i] as $value) {
                                        echo "
                                        <li><a href='#'><span><i class='fa-sharp fa-solid fa-tags'></i>".htmlspecialchars($value)."</span></a></li>
                                        ";
                                    }
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
        ?>
        <script src="../assets/js/script.js"></script>
    </body>
</html>