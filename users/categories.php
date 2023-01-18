<?php 
    session_start();
    include "../model.php";
    $categorieModel = new ModelCategories();

    if(!isset($_SESSION["user"])) {
        header("location: ../index.php");
    }

    if(isset($_GET["logout"])) {
        session_destroy();
        header("location: ../index.php");
    }

    if (isset($_SESSION["categorie_ajouter"])) {
        $categorie_ajouter = $_SESSION["categorie_ajouter"];
        echo "<script>
                alert('$categorie_ajouter est bien ajouter !');
            </script>";
        unset($_SESSION['categorie_ajouter']);
    };

    if(isset($_SESSION["categorie_exist"])) {
        $categorie_exist = $_SESSION["categorie_exist"];
        echo "<script>
            alert('Désoli! ce categorie: \"$categorie_exist\" est déja Ajouter ? !');
        </script>";
        unset($_SESSION["categorie_exist"]);
    }

    if(isset($_POST["categorie"])) {
        $categorie_name = $_POST["categorie"];
        $categorieModel->setCategories($categorie_name);
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
                <label for="categorie">Nouveau Catégories :</label>
                <input type="text" name="categorie" id="categorie">
                <input type="submit" value="Ajouter">
            </form>
            <div class="sidebar">
                <div class="row categories flex-c">
                    <h2>Categories</h2>
                    <ul class="flex-c">
                        <?php 
                            $categories = $categorieModel->getCategories();
                                for($i=0; isset($categories[$i]); $i++) {
                                    foreach($categories[$i] as $value) {
                                        echo "
                                        <li><a href='posts_categorie.php?$value'><span><i class='fa-sharp fa-solid fa-tags'></i>$value</span></a></li>
                                        ";
                                    }
                                }
                            // On ferme la connexion
                            $categorieModel->closeConnection();
                            ?>
                        </ul>
                </div>
            </div>
        </div>
    </main>
<?php include "footer.php" ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>