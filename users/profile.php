<?php 
    session_start();
    include "../model.php";
    $usersModel = new ModelUsers();
    if(!isset($_SESSION["user"], $_SESSION["role"])) {
        header("location: ../index.php");
        exit();
    } else {
        if($_SESSION["role"] != "user") {
            header("location: ../admin");
            exit();
        } else {
            if(isset($_GET["logout"])) {
                session_destroy();
                header("location: ../index.php");
                exit();
            }

            // si l'utilisateur clicker sur le button submit
            if(isset($_POST["nName"], $_POST["nEmail"], $_POST["nPassword"])) {
                $nouveauNom = $_POST["nName"];
                $nouveauEmail = $_POST["nEmail"];
                $nouveauPassword = $_POST["nPassword"];
                // executer la modification
                $usersModel->updateProfile($nouveauNom);
                $_SESSION["login"] = $usersModel->getUserDataById($_SESSION["userId"]);
                header("refresh:0");
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "../head.php" ?>
<body id="body" class="profile-body">
    <?php include "../header.php" ?>
    <main>
        <section class="presentation">
            <div class="container flex-c">
                <h2>Présentation</h2>
                <article class="content flex-r">
                    <div class="img-box">
                        <img src="../assets/img/image.jpg" alt="image">
                    </div>
                    <div class="info-box flex-c">
                        <h3><?php echo htmlspecialchars($_SESSION['login']->username) ?> welcome to your profile</h3>
                        <p><?php print_r($_SESSION['login']->presentation) ?></p>
                    </div>
                </article>
            </div>
        </section>
        <section class="edit-profile">
            <div class="container">
                <h2>Update Profile</h2>
                <form action="" method="post" class='edit-form flex-r'>

                    <div class='box-edit-form'>
                        <label for="nName">Nouveau Nom :</label>
                        <input type="text" name="nName" id="nName" class='inp-edit-form'>
                    </div>
                    
                    <div class='box-edit-form'>
                        <label for="nEmail">Nouveau Email :</label>
                        <input type="email" name="nEmail" id="nEmail" class='inp-edit-form'>
                    </div>

                    <div class='box-edit-form'>
                        <label for="nMetier">Nouveau Métier :</label>
                        <input type="text" name="nMetier" id="nMetier" class='inp-edit-form' >
                    </div>
                    <div class='box-edit-form'>
                        <label for="nPassword">Nouveau Password :</label>
                        <input type="password" name="nPassword" id="nPassword" class='inp-edit-form' >
                    </div>
                    <div class="box-txt-area">
                        <h4>A Propos de moi :</h4>
                        <textarea name="presentation" id="presentation" cols="90" rows="10" class='inp-edit-form'></textarea>
                    </div>

                    <div class='box-btn'>
                        <input type="submit" value='update' class='btn-custom'>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include "../footer.php" ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>