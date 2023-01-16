<?php 
    session_start();
    include "model.php";
    $conn = new connexion();
    if(isset($_SESSION['user'])) {
        header('location: index.php');
    }

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        if(!empty($username) && !empty($email) && !empty($password)) {
            $server_name = "localhost";
            $user = 'root';
            $passw = '';
            $dbname = "wahil";

            $conn->setUser($username, $email, $password);
            
            // On ferme la connexion
            $conn = null;
        }
    }
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
                <div class="form-group">
                    <label for="username">FULL NAME</label>
                    <input type="text" id="username" name="username" placeholder="Wahil Ch">
                </div>
                <div class="form-group">
                    <label for="Email">EMAIL ADDRESS</label>
                    <input type="email" id="email" name="email" placeholder="wahilchettouf@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" value="Sign Up">
                </div>
            </form>
            <p>I'm already a member! <a href="login.php">Sign In</a></p>
        </div>
    </section>
</body>