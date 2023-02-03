<?php 
    include "inc/config.php";
    include $BlogPathInclude."inc/model.php";
    $usersModel = new ModelUsers();

    if(isset($_SESSION["login"])) {
        if($_SESSION["login"]->role == "user") {
            header("location: ".$BlogPathLien."users/");
            exit();
        } else {
            header("location: ".$BlogPathLien."admin/");
            exit();
        }
    }

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cPassword'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cPassword = $_POST["cPassword"]; //confirm password
        if(!empty($username) && !empty($email) && !empty($password) && !empty($password)) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if($password === $cPassword) {
                    $usersModel->setUser($username, $email, $password);
                } else {
                    $_SESSION["error-confirm-password"] = true;
                    header("refresh:0");
                    exit();
                }
            } else {
                $_SESSION["email-error"] = true;
            }
        } else {
            $_SESSION["champs-vide"] = true;
        }
    }

    if(isset($_SESSION["user_bien_inscrit"])) {
        header("location: login.php");
        exit();
    }

    // On ferme la connexion
    $usersModel->closeConnection();
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "inc/head.php" ?>
    <body class="flex-r register-body">
        <div class="return-acceuil">
            <a href="<?php echo $BlogPathLien?>index.php">Acceuil</a>
        </div>
        <section class="register flex-r">
            <div class="container-register flex-c">
                <img src="<?php echo $BlogPathLien?>assets/img/bg-register.jpg" alt="bg-register">
                <h3>Create Your Account</h3>
                <form method="post" class="register-form">
                    <?php if(isset($_SESSION["user_exist"])) {
                        echo "<p class='error-msg'>Désoli! cette email : ".htmlspecialchars($_SESSION["user_exist"])." est déja utiliser !</p>";
                        unset($_SESSION["user_exist"]);
                    }?>
                    <div class="form-group">
                        <label for="username">FULL NAME</label>
                        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ""?>" placeholder="Wahil Ch" required>
                    </div>
                    <div class="form-group">
                        <label for="Email">EMAIL ADDRESS</label>
                        <input type="email" id="email" name="email" placeholder="wahilchettouf@gmail.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""?>" required>
                        <?php if(isset($_SESSION["email-error"])) {
                            echo "<p class='error-msg'>Entrer validate email !</p>";
                            unset($_SESSION['email-error']);
                        }?>
                    </div>
                    <div class="form-group">
                        <label for="password">PASSWORD</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="cPassword">CONFIRM PASSWORD</label>
                        <input type="password" id="cPassword" name="cPassword" placeholder="Confirm Password" required>
                        <?php if(isset($_SESSION["error-confirm-password"])) {
                            echo "<p class='error-msg'>confirm password is not equal password !</p>";
                            unset($_SESSION['error-confirm-password']);
                        }?>
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
        <?php }; 
            unset($_SESSION['champs-vide']);
        ?>
    </body>
</html>