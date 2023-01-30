<?php 
    include "../../config.php";
    include $BlogPathInclude."model.php";
    $categoriesModel = new ModelCategories();

    if(!isset($_SESSION["login"])) {
        header("location:".$BlogPathLien."index.php");
        exit();
    } else {
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION["login"]->role != "admin") {
                header("location:".$BlogPathLien."users/index.php");
                exit();
            } else {
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location:".$BlogPathLien."index.php");
                    exit();
                }
        
                if (isset($_SESSION["category_ajouter"])) {
                    $category_ajouter = $_SESSION["category_ajouter"];
                    echo "<script>
                            alert('$category_ajouter est bien ajouter !');
                        </script>";
                    unset($_SESSION['category_ajouter']);
                    header('refresh: 0.5; URL=../posts_manager/new_post.php');
                    exit();
                };
            
                if(isset($_POST["category"])) {
                    if(!empty($_POST["category"])) {
                        $category_name = $_POST["category"];
                        $categoriesModel->setCategories($category_name, $_SESSION["login"]->id);
                    } else {
                        $_SESSION["champs-vide"] = true;
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include $BlogPathInclude."head.php" ?>
    <body id="body" class="post-categorie">
        <?php include $BlogPathInclude."header.php" ?>
        <main class="content">
            <div class="container">
                <form method="post" class="form-categorie">
                    <label for="category">New Category :</label>
                    <input type="text" name="category" id="category" required>
                    <?php 
                        if(isset($_SESSION["category_exist"])) {
                            echo "<p class='error-msg'>Category existe déja !</p>";
                            unset($_SESSION["category_exist"]);
                        }
                        if(isset($_SESSION['champs-vide'])) {
                            echo "<p class='error-msg'>Champs vide !</p>";
                            unset($_SESSION["champs-vide"]);
                        }
                    ?>

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
        <script src="<?php echo $BlogPathLien?>assets/js/script.js"></script>
    </body>
</html>