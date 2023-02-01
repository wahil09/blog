<?php 
    include "../../config.php";
    include $BlogPathInclude."model.php";
    $categoriesModel = new ModelCategories();
    $categories = $categoriesModel->getCategories();

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
                        header("location: new_category.php");
                        exit();
                    }
                }
            }
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
                    <h2 class="title-panel-page">manage categories</h2> 

                    <form method="post" action="" class="new-category-form">
                        <label for="category">Category Name :</label>
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
                        <input type="submit" value="Save Category" class="btn-panel">
                    </form>

                    <div class="categories-box">
                        <h2>Categories</h2>
                        <ul class="flex-r">
                            <?php 
                            $categories = $categoriesModel->getCategories();
                            if(!empty($categories)) :?>
                                <?php for($i=0; isset($categories[$i]); $i++) :?>
                                    <li>
                                            <a class='btn-panel' href='<?php echo $adminPathLien ?>posts_categories.php?id=<?php echo $categories[$i]['id'] ?>'>
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
