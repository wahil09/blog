<?php 
    include "../inc/config.php";
    include $BlogPathInclude."inc/model.php";
    $usersModel = new ModelUsers();

    if(!isset($_SESSION["login"])) {
        header("location:".$BlogPathLien);
        exit();
    } else {
        if($_SESSION['login']->role != "user") {
            header("location: ".$BlogPathLien."admin/index.php");
            exit();
        }
    }
    
    if(isset($_GET["logout"])) {
        require_once($BlogPathInclude."inc/logout.php");
    }

    // si l'utilisateur taper sur le button submit
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
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include $BlogPathInclude."inc/head.php" ?>
    <body id="body" class="profile-body">
        <?php include $BlogPathInclude."inc/header.php" ?>
        <main>
            <section class="presentation">
                <div class="container flex-c">
                    <h2>Présentation</h2>
                    <article class="content flex-r">
                        <div class="img-box">
                            <img src="<?php echo $BlogPathLien?>assets/img/image.jpg" alt="image">
                        </div>
                        <div class="info-box flex-c">
                            <h3><?php echo htmlspecialchars($_SESSION['login']->username) ?> welcome to your profile</h3>
                            <p><?php echo $_SESSION['login']->presentation ?></p>
                            <p>Métier : <?php echo $_SESSION['login']->job ?></p>
                            <p>Email : <?php echo $_SESSION['login']->email ?></p>
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
        <?php
            // on ferme la connexion
            $usersModel->closeConnection(); 
            include  $BlogPathInclude."inc/footer.php"; 
        ?>
        <script src="<?php echo $BlogPathLien?>assets/js/script.js"></script>
    </body>
</html>