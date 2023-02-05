<?php 
    require_once("../../inc/config.php");
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
            
    // delete category
    if(isset($_GET["delete"])) {
        $categoryId = $_GET["delete"];
        $categoriesModel->deleteById($categoryId, $categoriesModel->getTableName());
        header("location:".$_SERVER['PHP_SELF']);
        exit();
    }
?>
<!DOCTYPE html>
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
                    <?php if(!empty($categories)) :?>
                        <table>
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Name</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0; isset($categories[$i]); $i++) :?>
                                    <tr>
                                        <td><?= $categories[$i]['id'] ?></td>
                                        <td><?= htmlspecialchars($categories[$i]['categoryName']) ?></td>
                                        <td class="action-content">
                                        <ul class="flex-r">
                                            <li><a href="" class="first-action">edit</a></li>
                                            <li><a href="?delete=<?php echo $categories[$i]['id']?>" class="second-action">delete</a></li>
                                        </ul>
                                    </td>
                                    </tr>
                                <?php endfor ?>
                            </tbody>
                        </table>
                    <?php else :?>
                        <p>Aucune Category existe!</p>
                    <?php endif ?>
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