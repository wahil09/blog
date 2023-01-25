<?php 
    include "model.php";
    $usersModel = new ModelUsers();
    session_start();
    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if(!empty($email) && !empty($password)) {
            $userAlreadyRegistered = $usersModel->userAlreadyRegistered($email, $password);
            if($userAlreadyRegistered) {
                $_SESSION["role"] = $userAlreadyRegistered->role;
                if($userAlreadyRegistered->role == "user") {
                    $_SESSION["user"] = $userAlreadyRegistered->username;
                    $_SESSION["userId"] = $userAlreadyRegistered->id;
                    header("location: users/index.php");
                    exit();
                } elseif($userAlreadyRegistered->role == "admin") {
                    $_SESSION["user"] = $userAlreadyRegistered->username;
                    $_SESSION["adminId"] = $userAlreadyRegistered->id;
                    header("location: admin/index.php");
                    exit();
                }
            } else {
                $_SESSION["error_login_user"] = $email;
                header("location: login.php");
                exit();
            }
        }
        $usersModel->closeConnection();
    }

    if(isset($_SESSION["user"], $_SESSION["role"])) {
        if($_SESSION["role"] == "user") {
            header("location: users/index.php");
            exit();
        } else {
            header("location: admin/index.php");
            exit();
        }
    }

    if (isset($_SESSION["user_inscrit"])) {
        $user_inscrit = $_SESSION["user_inscrit"];
        echo "<script>
                alert('$user_inscrit vous ètez bien Inscrit !');
            </script>";
        unset($_SESSION['user_inscrit']);
    };

    if(isset($_SESSION['error_login_user'])) {
        $user_veut_connecter = $_SESSION['error_login_user'];
        echo "<script>
                alert('$user_veut_connecter votre identifiant n\'est pas valide !');
            </script>";
        unset($_SESSION['error_login_user']);
    }

    if(isset($_SESSION["user_exist"])) {
        $user_exist = $_SESSION["user_exist"];
        echo "<script>
            alert('Désoli! ce email: \"$user_exist\" est déja utiliser ? !');
        </script>";
        unset($_SESSION["user_exist"]);
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
    <body class="flex-r login-body" style="position: relative">
        <div class="return-acceuil">
            <a href="index.php">Acceuil</a>
        </div>
        <section class="login flex-r">
            <div class="container-login flex-c">
                <h1>Sign In With</h1>
                <ul class="row-box flex-r">
                    <li><a class="flex-r" href="#"><img src="assets/img/facebook.png">Facebook
                    </a></li>
                    <li><a class="flex-r" href="#"><img src="assets/img/icon-google.png">Google</a></li>
                </ul>
                <form action="" method="post" class="row-box flex-c">
                    <div class="inp-box">
                        <label for="email">Email</label>
                        <input class="inp" type="email" name="email" id="email" required>
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
        <div class="error-login-box" id="errorLoginBox">
            <div class="row-1 flex-r">
                <h3>Login failed</h3>
                <span id="supErrorLoginBox"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <hr>
            <div class="row-2 flex-r">
                <p>Login failed: Remplire le formulaire !</p>
            </div>
        </div>
        <?php 
            if(isset($_SESSION['error'])) {
                echo "
                    <script>
                        const errorLoginBox = document.querySelector('#errorLoginBox');
                        errorLoginBox.classList.add('afficher-login-box');

                        const supErrorLoginBox = document.querySelector('#supErrorLoginBox');

                        supErrorLoginBox.addEventListener('click', function() {
                            errorLoginBox.classList.remove('afficher-login-box');
                        })
                    </script>";
            }
            unset($_SESSION['error']);
        ?>

    </body>
</html>