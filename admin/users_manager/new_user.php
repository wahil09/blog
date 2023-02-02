<?php 
    include "../../config.php";
    include $BlogPathInclude."model.php";
    $usersModel = new ModelUsers();
    $users = $usersModel->getUsers();
    // vérifier si quellqu'un est connécter
    if(!isset($_SESSION["login"])) {
        header("location: ../../index.php");
        exit();
    } else {
        // vérifier qui est connécter
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION['login']->role != "admin") {
                header("location: ".$BlogPathLien."index.php");
                exit();
            } else {
                // pour la déconnexion
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location: ../../index.php");
                    exit();
                }

                if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cPassword']) && isset($_POST['role'])) {
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $cPassword = $_POST["cPassword"]; //confirm password
                    $role = $_POST["role"]; //confirm password
                    if(!empty($username) && !empty($email) && !empty($password) && !empty($password) && !empty($role)) {
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            if($password === $cPassword) {
                                $usersModel->setUser($username, $email, $password, $role);
                            } else {
                                $_SESSION["error-confirm-password"] = true;
                                header("refresh:0");
                                exit();
                            }
                        } else {
                            $_SESSION["email-error"] = true;
                            header("refresh:0");
                            exit();
                        }
                    } else {
                        $_SESSION["champs-vide"] = true;
                    }
                }

                // redirection to manage_users
                if(isset($_SESSION["user_bien_inscrit"])) {
                    header("location: manage_users.php");
                    exit();
                }
            }
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

                        <?php if(isset($_SESSION["user_exist"])) {
                            echo "<p class='error-msg'>Désoli! cette email : ".$_SESSION["user_exist"]." est déja utiliser !</p>";
                            unset($_SESSION["user_exist"]);
                        }?>
                            <label for="username">username</label>
                            <input type="text" id="username" class="inp-style" name="username" placeholder="name" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ""?>" required>

                            <label for="Email">email</label>
                            <input type="email@gmail.com" id="email" class="inp-style" name="email" placeholder="email"  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""?>" required>

                            <?php if(isset($_SESSION["email-error"])) {
                                echo "<p class='error-msg'>Entrer validate email !</p>";
                                unset($_SESSION['email-error']);
                            }?>

                            <label for="password">password</label>
                            <input type="password" id="password" class="inp-style" name="password" placeholder="Password" required>

                            <label for="cPassword">password confirmation</label>
                            <input type="password" id="cPassword" class="inp-style" name="cPassword" placeholder="Confirm Password" required>

                            <?php if(isset($_SESSION["error-confirm-password"])) {
                                echo "<p class='error-msg'>confirm password is not equal password !</p>";
                                unset($_SESSION['error-confirm-password']);
                            }?>


                            <label for="role">rôle</label>
                            <select name="role" id="role" class="inp-style">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>

                            <input type="submit" id="submit" class="btn-panel" value="Sign Up">
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