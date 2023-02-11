<?php 
    include "../../inc/config.php";
    include $BlogPathInclude."inc/model.php";
    $categoriesModel = new ModelCategories();
    $categories = $categoriesModel->getCategories();

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
        
    if (isset($_SESSION["category_modifier"])) {
        echo "<script>
                alert('category bien modifier !');
            </script>";
        unset($_SESSION['category_modifier']);
        header("refresh: 0.1; URL=".$adminPathLien."categories_manager/manage_categories.php");
        exit();
    };

    if(isset($_POST["nCategory"], $_GET["category_id"])) {
        $categoryId = $_GET["category_id"];
        if(!empty($categoriesModel->checkIfExistById($categoryId, "categories"))) {
            if(!empty($_POST["nCategory"])) {
                $nCategory = $_POST["nCategory"];
                $categoriesModel->updateCategory($nCategory, $categoryId);
                header("location: edit_category.php?category_id=".$categoryId);
                exit();
            } else {
                $_SESSION["champs-vide"] = true;
                header("location: edit_category.php?category_id=".$categoryId);
                exit();
            }
        } else {
            echo "<script>
                alert('category n\'existe pas!');
            </script>";
            header("refresh: .1; URL=".$adminPathLien."categories_manager/manage_categories");
            exit();
        }
    }
?>
<html lang="fr-FR">
<?php require_once($adminPathInclude."inc/head.php")?>
<body>
    <div class="content">
        <?php include($adminPathInclude."inc/header.php");?>
        <main class="container-panel">
            <?php require_once($adminPathInclude."inc/side-bare.php")?>
            <section class="box-content-panel">
                <div class="content-panel">
                    <ul>
                        <li><a href="new_category.php" class="btn-panel">add category</a></li>
                        <li><a href="manage_categories.php" class="btn-panel">manage categories</a></li>
                    </ul>
                    <div class="clear"></div>
                    <h2 class="title-panel-page">edit category</h2> 
                    <?php if(isset($_GET["category_id"])) :?>
                        <form method="post" action="" class="category-form">
                            <label for="nCategory">Nouvelle nom :</label>
                            <input type="text" name="nCategory" id="nCategory" class='category' required>
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
                            <input type="submit" value="Save Change" class="btn-panel">
                        </form>
                    <?php else :?>
                        <h4 class='error-table-vide'>aucune category séléctionner pour le modifier!</h4>
                    <?php endif ?>

                    <div class="categories-box">
                        <h2>Categories</h2>
                        <ul class="flex-r">
                            <?php 
                            $categories = $categoriesModel->getCategories();
                            if(!empty($categories)) :?>
                                <?php for($i=0; isset($categories[$i]); $i++) :?>
                                    <li>
                                            <a class='btn-panel' href='<?php echo $adminPathLien ?>inc/posts_categories.php?id=<?php echo $categories[$i]['id'] ?>'>
                                                <span><?php echo htmlspecialchars($categories[$i]['categoryName'])?></span>
                                        </a>
                                    </li>
                                <?php endfor ?>
                            <?php else :?>
                                <p>aucune categorie existe !</p>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php
        // On ferme la connexion
        $categoriesModel->closeConnection();
    ?>
</body>
</html>
