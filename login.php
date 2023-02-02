<?php 
    include "config.php";
    include $BlogPathInclude."model.php";
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

    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if(!empty($email) && !empty($password)) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $userObject = $usersModel->userAlreadyRegistered($email, $password);
                if($userObject) {
                    $_SESSION["login"] = $userObject;
                } else {
                    $_SESSION["error_login_user"] = $email;
                } 
            } else {
                $_SESSION["email-error"] = true;
                header("refresh:0");
                exit();
            }
        } else {
            $_SESSION["champs-vide"] = true;
        }
        // on ferme la connexion
        $usersModel->closeConnection();
    }

    if (isset($_SESSION["user_bien_inscrit"])) {
        $user_inscrit = $_SESSION["user_bien_inscrit"];
        echo "<script>
                alert('$user_inscrit vous ètez bien Inscrit !');
            </script>";
        unset($_SESSION['user_bien_inscrit']);
    };
?>

<!DOCTYPE html>
<html lang="fr-FR">
<?php include $BlogPathInclude."head.php" ?>
    <body class="flex-r login-body" style="position: relative">
        <div class="return-acceuil">
            <a href="index.php">Acceuil</a>
        </div>
        <section class="login flex-r">
            <div class="container-login flex-c">
                <h1>Sign In With</h1>
                <ul class="row-box flex-r">
                    <li><a class="flex-r" href="#"><img src="<?php echo $BlogPathLien?>assets/img/facebook.png">Facebook
                    </a></li>
                    <li><a class="flex-r" href="#"><img src="<?php echo $BlogPathLien?>assets/img/icon-google.png">Google</a></li>
                </ul>
                <form action="" method="post" class="row-box flex-c">
                    <!-- afficher un paragraph quand les informations entrer pas valide -->
                    <?php if(isset($_SESSION['error_login_user'])) {
                        echo "<p class='error-msg'>votre identifiant n'est pas valide !</p>";
                        unset($_SESSION['error_login_user']);
                    } ?>
                    <div class="inp-box">
                        <label for="email">Email</label>
                        <input class="inp" type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""?>" required>
                        <?php if(isset($_SESSION["email-error"])) {
                            echo "<p class='error-msg'>Entrer validate email !</p>";
                            unset($_SESSION['email-error']);
                        }?>
                    </div>
                    <div class="inp-box">
                        <label for="password">Password</label><!-- <a href="#">Forgot?</a> -->
                        <input class="inp" type="password" name="password" id="password" required>
                    </div>
                    <div class="inp-box">
                        <input class="inp" type="submit" value="Sign In" name="submit" id="submit">
                    </div>
                </form>
                <p>Not a member? <a href="register.php">Sign up now</a></p>
            </div>
        </section>
        <div class="error-box" id="errorLoginBox">
            <div class="row-1 flex-r">
                <h3>Login failed</h3>
                <span id="supErrorLoginBox"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <hr>
            <div class="row-2 flex-r">
                <p>Login failed: formulaire Vide !</p>
            </div>
        </div>
        <?php 
            if(isset($_SESSION['champs-vide'])) { ?>
                    <script>
                        const errorLoginBox = document.querySelector('#errorLoginBox');
                        errorLoginBox.classList.add('afficher-error-box');

                        const supErrorLoginBox = document.querySelector('#supErrorLoginBox');

                        supErrorLoginBox.addEventListener('click', function() {
                            errorLoginBox.classList.remove('afficher-error-box');
                        })
                    </script>
            <?php }; unset($_SESSION['champs-vide']); ?>
    </body>
</html>