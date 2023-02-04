<?php 
    include "../../inc/config.php";
    include $BlogPathInclude."inc/model.php";
    $usersModel = new ModelUsers();
    $users = $usersModel->getUsers();
    // vérifier si quellqu'un est connécter
    if(!isset($_SESSION["login"])) {
        header("location:".$BlogPathLien);
        exit();
    } else {
        if($_SESSION['login']->role != "admin") {
            header("location: ".$BlogPathLien."users/");
            exit();
        }
    }

    // pour la déconnexion
    if(isset($_GET["logout"])) {
        require_once($BlogPathInclude."inc/logout.php");
    }


    // tableaux d'erreurs
    $errors = [
        "emailError" => "",
        "passwordError" => "",
        "identifiantError" => "",
        "champVide" => "",
        "confirmPassError" => "",
        "emailExist" => "",
        "siteError" => "",
    ];

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cPassword'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cPassword = $_POST["cPassword"]; //confirm password
        if(!empty($username) && !empty($email) && !empty($password) && !empty($password)) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // validation password : il faut qu'il contient
                $uppercase = preg_match('@[A-Z]@', $password); // lettre en majuscule
                $lowercase  = preg_match("@[a-z]@", $password); // lettre en minuscule
                $number = preg_match("@[0-9]@", $password); // un numéro
                $specialChars = preg_match("@[^\w]@", $password); // caractère spéciaux 
                $passLength = strlen($password) >= 8; // 8 caractère au min
                if($uppercase && $lowercase && $number && $specialChars && $passLength) {
                    if($password === $cPassword) {
                        // check if user exist
                        if(!$usersModel->isExist($email)) {
                            // si tout est bon mail il y'a des problème coté serveur, database ...
                            if(!$usersModel->setUser($username, $email, $password)) {
                                $_SESSION["user_inscrit"] = $username;
                                header("location: ".$adminPathLien."users_manager/manage_users.php");
                                exit();
                            } else {
                                $errors["siteError"] = "Error base de donnes !";
                            }
                        } else {
                            $errors["emailExist"] = "Désoli! ce email : ".htmlspecialchars($email)." est déja utiliser !";
                        }
                    } else {
                        $errors['confirmPassError'] = "merci de confirmer que le confirm mote de passe ressembler au mote de pass";
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
    }
?>

<!DOCTYPE html>
<html lang="fr-FR">
<?php require_once($adminPathInclude."inc/head.php")?>
<body>
    <div class="content">
        <?php require_once($adminPathInclude."inc/header.php");?>
        <main class="container-panel">
            <?php require_once($adminPathInclude."inc/side-bare.php")?>
            <section class="box-content-panel">
                <div class="content-panel">
                    <ul>
                        <li><a href="new_user.php" class="btn-panel">add user</a></li>
                        <li><a href="manage_users.php" class="btn-panel">manage users</a></li>
                    </ul>
                    <div class="clear"></div>
                    <h2 class="title-panel-page">create user</h2> 
                    <form method="post" class="form-new-user flex-c">
                        <!-- si l'email est déja utiliser -->
                        <?php echo "<p class='error-msg'>".$errors['emailExist']."</p>";?>
                        <label for="username">username</label>
                        <input type="text" id="username" class="inp-style" name="username" placeholder="name" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ""?>" required>

                        <label for="Email">email</label>
                        <input type="email@gmail.com" id="email" class="inp-style" name="email" placeholder="email"  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""?>" required>

                        <label for="password">password</label>
                        <input type="password" id="password" class="inp-style" name="password" placeholder="Password" required>

                        <label for="cPassword">password confirmation</label>
                        <input type="password" id="cPassword" class="inp-style" name="cPassword" placeholder="Confirm Password" required>

                        <label for="role">rôle</label>
                        <select name="role" id="role" class="inp-style">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>

                        <input type="submit" id="submit" class="btn-panel" value="Sign Up">
                        <?php echo "<p class='error-msg'>".$errors['emailError']."</p>";?>
                        <?php echo "<p class='error-msg'>".$errors['identifiantError']."</p>";?>
                        <?php echo "<p class='error-msg'>".$errors['champVide']."</p>";?>
                        <?php echo "<p class='error-msg'>".$errors['passwordError']."</p>";?>
                        <?php echo "<p class='error-msg'>".$errors['confirmPassError']."</p>";?>
                        <?php echo "<p class='error-msg'>".$errors['siteError']."</p>";?>
                    </form>
                </div>
            </section>
        </main>
    </div>
    <?php
        // On ferme la connexion
        $usersModel->closeConnection();
    ?>
</body>
</html>