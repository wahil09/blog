<?php 
    session_start();
    if(!isset($_SESSION["user"], $_SESSION["role"])) {
        header("location: ../index.php");
        exit();
    } else {
        if($_SESSION['role'] != "admin") {
            header("location: ../users/index.php");
            exit();
        }
    }

    if(isset($_GET["logout"])) {
        session_destroy();
        header("location: ../index.php");
        exit();
    }

    if(isset($_GET['users'])) {
        header("location: afficher_users.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "../head.php" ?>
<body id="body">
    <?php include "header.php" ?>
    <main>
        <section class="presentation">
            <div class="container flex-c">
                <h2>Présentation</h2>
                <article class="content flex-r">
                    <div class="img-box">
                        <img src="../assets/img/image.jpg" alt="image">
                    </div>
                    <div class="info-box flex-c">
                        <h3><?php echo $_SESSION['user'] ?> welcome to your profile</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam alias eius dolorem earum eaque blanditiis? Tenetur voluptatibus commodi quod in?</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam alias eius dolorem earum eaque blanditiis? Tenetur voluptatibus commodi quod in? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo obcaecati totam fuga numquam? Minus accusantium facilis quidem, quod aperiam aliquam.</p>
                    </div>
                </article>
            </div>
        </section>
    </main>
    <?php include "../footer.php" ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>