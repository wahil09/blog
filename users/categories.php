<?php 
    session_start();
    include "../model.php";
    $categoriesModel = new ModelCategories();

    if(!isset($_SESSION["user"])) {
        header("location: ../index.php");
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
            $categoriesModel->setCategories($category_name);
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
    <body id="body" class="post-categorie">
        <?php include "header.php" ?>
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
                                    for($i=0; isset($categories[$i]); $i++) {
                                        foreach($categories[$i] as $value) {
                                            echo "
                                            <li><a href='posts_categorie.php?$value'><span><i class='fa-sharp fa-solid fa-tags'></i>$value</span></a></li>
                                            ";
                                        }
                                    }
                                // On ferme la connexion
                                $categoriesModel->closeConnection();
                            ?>
                        </ul>
                        <p id="paraEmptyCategories" class=''>aucune categorie existe !</p>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include "footer.php";
            include "../aff_tableau_vide.php";
        ?>
        <script src="../assets/js/script.js"></script>
    </body>
</html>