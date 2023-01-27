<?php 
    session_start();
    include "model.php";
    $usersModel = new ModelUsers();
    if(isset($_SESSION['login'])) {
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION["login"]->role == "user") {
                header("location: users/");
                exit();
            } else {
                header("location: admin/");
                exit();
            }
        }
    }

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        if(!empty($username) && !empty($email) && !empty($password)) {
            $usersModel->setUser($username, $email, $password);
        } else {
            $_SESSION["champs-vide"] = true;
        }
    }

    // On ferme la connexion
    $usersModel->closeConnection();
?>

<!DOCTYPE html>
<html lang="fr-FR">
<?php include "head.php" ?>
<body class="flex-r register-body">
    <div class="return-acceuil">
        <a href="index.php">Acceuil</a>
    </div>
    <section class="register flex-r">
        <div class="container-register flex-c">
            <img src="assets/img/bg-register.jpg" alt="bg-register">
            <h3>Create Your Account</h3>
            <form method="post" class="register-form">
                <?php if(isset($_SESSION["user_exist"])) {
                    echo "<p class='error-msg'>Désoli! cette email : ".$_SESSION["user_exist"]." est déja utiliser !</p>";
                    unset($_SESSION["user_exist"]);
                }?>
                <div class="form-group">
                    <label for="username">FULL NAME</label>
                    <input type="text" id="username" name="username" placeholder="Wahil Ch" required>
                </div>
                <div class="form-group">
                    <label for="Email">EMAIL ADDRESS</label>
                    <input type="email" id="email" name="email" placeholder="wahilchettouf@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" value="Sign Up">
                </div>
            </form>
            <p>I'm already a member! <a href="login.php">Sign In</a></p>
        </div>
    </section>
    <div class="error-box" id="errorRegisterBox">
        <div class="row-1 flex-r">
            <h3>Login failed</h3>
            <span id="supErrorRegisterBox"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <hr>
        <div class="row-2 flex-r">
            <p>Login failed: formulaire Vide !</p>
        </div>
    </div>
    <?php 
        if(isset($_SESSION['champs-vide'])) { ?>
            <script>
                const errorLoginBox = document.querySelector('#errorRegisterBox');
                errorLoginBox.classList.add('afficher-error-box');

                const supErrorLoginBox = document.querySelector('#supErrorRegisterBox');

                supErrorLoginBox.addEventListener('click', function() {
                    errorLoginBox.classList.remove('afficher-error-box');
                })
            </script>
    <?php }; unset($_SESSION['champs-vide']);?>
</body>