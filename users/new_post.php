<?php 
    session_start();
    include "../model.php";
    $conn = new ModelCategories();
    if(!isset($_SESSION["user"])) {
        header("location: ../index.php");
    }

    if(isset($_GET["logout"])) {
        session_destroy();
        header("location: ../index.php");
    }



?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
<body id="body" class="post-categorie">
    <?php include "header.php" ?>
    <main class="content">
            <div class="container">
                <section class='new-post'>
                    <h2>Nouveau Article :</h2>
                    <form enctype="multipart/form-data" action="upload_image.php" method="post" class="flex-c form-new-post">
                        <div class="inp-box">
                            <label for="title">Article name : </label>
                            <input type="text" name="title" id="title" required>
                        </div>
                        <div class="inp-box">
                            <label for="Categories">Categories : </label>
                            <select name="Categories" id="Categories" required>
                                <option value="">Choisir un categorie ...</option>
                                <?php
                                    for($i=0; isset($conn->getCategories()[$i]); $i++) {
                                        foreach($conn->getCategories()[$i] as $value) {
                                            echo "
                                            <option value='$value'>$value</option>
                                            ";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="inp-box">
                            <label for="fileToUpload">Article image : </label>
                            <input type="file" name="fileToUpload" id="fileToUpload" required>
                        </div>
                        <div class="inp-box">
                            <textarea name="post-text" id="post-text" cols="90" rows="10" required></textarea>
                        </div>
                        <div class="inp-box">
                            <input type="submit" value="upload">
                        </div>
                    </form>
                </section>

                <div class="sidebar">
                    <div class="row last-posts flex-c">
                        <h2>dernier posts</h2>
                        <ul class="flex-c">
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-1.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-2.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-3.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    <?php include "footer.php" ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>