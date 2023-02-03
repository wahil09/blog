<?php 
    include "inc/config.php";
    include $BlogPathInclude."inc/model.php";
    $usersModel = new ModelUsers();
    $errors = [
        "emailError" => "",
        "passwordError" => "",
        "identifiantError" => "",
        "champVide" => "",
    ];

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
            // validation email
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // validation password : il faut qu'il contient
                $uppercase = preg_match('@[A-Z]@', $password); // lettre en majuscule
                $lowercase  = preg_match("@[a-z]@", $password); // lettre en minuscule
                $number = preg_match("@[0-9]@", $password); // un numéro
                $specialChars = preg_match("@[^\w]@", $password); // caractère spéciaux 
                $passLength = strlen($password) >= 8; // 8 caractère au min
                if($uppercase && $lowercase && $number && $specialChars && $passLength) {
                    $userObject = $usersModel->userAlreadyRegistered($email, $password);
                    if($userObject) {
                        $_SESSION["login"] = $userObject;
                        header("refresh:0");
                        exit();
                    } else {
                        $errors['identifiantError'] = "votre identifiant n'est pas valide !";
                    } 
                } else {
                    $errors["passwordError"] = "Confirmer que le mote de passe contient :<br> au moins 1 caractère en majuscule, en minuscule, un muméro, caractère spéciaux, 8 caractère au min !";
                }
            } else {
                $errors['emailError'] = "Entrer une email valide !";
            }
        } else {
            $errors['champVide'] = "un ou plusieurs champs de formulaire sont vide !";
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
<?php include $BlogPathInclude."inc/head.php" ?>
    <body class="flex-r login-body" style="position: relative">
        <div class="return-acceuil">
            <a href="<?php $BlogPathLien?>index.php">Acceuil</a>
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
                    <div class="inp-box">
                        <label for="email">Email</label>
                        <input class="inp" type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""?>" >
                    </div>
                    <div class="inp-box">
                        <label for="password">Password</label><!-- <a href="#">Forgot?</a> -->
                        <input class="inp" type="password" name="password" id="password" >
                    </div>
                    <div class="inp-box">
                        <input class="inp" type="submit" value="Sign In" name="submit" id="submit">
                    </div>
                    <?php echo "<p class='error-msg'>".$errors['emailError']."</p>";?>
                    <?php echo "<p class='error-msg'>".$errors['identifiantError']."</p>";?>
                    <?php echo "<p class='error-msg'>".$errors['champVide']."</p>";?>
                    <?php echo "<p class='error-msg'>".$errors['passwordError']."</p>";?>
                </form>
                <p>Not a member? <a href="register.php">Sign up now</a></p>
            </div>
        </section>
    </body>
</html>