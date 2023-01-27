<?php 
    session_start();
    include "../model.php";
    $usersModel = new ModelUsers();
    if(!isset($_SESSION["login"])) {
        header("location: ../index.php");
        exit();
    } else {
        
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION["login"]->role != "user") {
                header("location: ../admin");
                exit();
        } else {
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location: ../index.php");
                    exit();
                }
                // si l'utilisateur clicker sur le button submit
                if(isset($_POST["nName"], $_POST["nEmail"], $_POST["nPassword"], $_POST["nMetier"], $_POST["nPresentation"])) {
                    $nouveauNom = $_POST["nName"];
                    $nouveauEmail = $_POST["nEmail"];
                    $nouveauPassword = $_POST["nPassword"];
                    $nouveauMetier = $_POST["nMetier"];
                    $nouveauPresentation = $_POST["nPresentation"];
                    // executer la modification
                    $usersModel->updateProfile($nouveauNom, $nouveauEmail, $nouveauPassword, $nouveauMetier, $nouveauPresentation);
                    $_SESSION["login"] = $usersModel->getUserDataById($_SESSION["login"]->id);
                    header("refresh:0");
                    exit();
                }
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
                        <p><?php echo $_SESSION['login']->presentation ?></p>
                        <p>Métier : <?php echo $_SESSION['login']->job ?></p>
                        <p>Métier : <?php echo $_SESSION['login']->email ?></p>
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
                        <textarea name="nPresentation" id="nPresentation" cols="90" rows="10" class='inp-edit-form'></textarea>
                    </div>

                    <div class='box-btn'>
                        <input type="submit" value='update' class='btn-custom'>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include "../footer.php";
        // on ferme la connexion
        $usersModel->closeConnection(); 
    ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>