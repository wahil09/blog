<?php 
    session_start();
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

        // Methode 1 pour connecter au base du donnés en utilisent mysqli !
        //     // On établit la connexion
        //     $conn = new mysqli($server_name, $user, $passw);

        //     // On vérifie la connexion
        //     if($conn->connect_error) {
        //         die("Erreur : " .$conn->connect_error);
        //     }
        //     echo "connexion réussie";

        //     // On ferme la connexion
               // $conn->close();


        // Methode 2 pour connecter au base du donnés en utilisent PDO !

        /* --- Vous pouvez déjà remarquer ici que pour se connecter à une base de données avec PDO, vous devez passer son nom dans le constructeur de la classe PDO. Cela implique donc qu’il faut que la base ait déjà été créée au préalable (avec phpMyAdmin par exemple) ou qu’on la crée dans le même script.

        Notez également qu’avec PDO il est véritablement indispensable que votre script gère et capture les exceptions (erreurs) qui peuvent survenir durant la connexion à la base de données.

        En effet, si votre script ne capture pas ces exceptions, l’action par défaut du moteur Zend (plus de détail sur le moteur ici) va être de terminer le script et d’afficher une trace. Cette trace contient tous les détails de connexion à la base de données (nom d’utilisateur, mot de passe, etc.). Nous devons donc la capturer pour éviter que des utilisateurs malveillants tentent de la lire. --- */

            // On essaie de se connecter
            try {
                // On établit la connexion
                $conn = new PDO("mysql:host=$server_name; dbname=$dbname", $user, $passw);

                // On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // if user exist in database
                $sth = $conn->prepare("SELECT * FROM users WHERE email= :email"); //return 1 si vrai
                $sth->bindValue("email", $email);
                $sth->execute();
                if(empty($sth->fetch())) {
                    echo "bvb";
                    // On ajoute un nouveau utilisateur
                    $newUser = "INSERT INTO users(username, email, password, role) VALUES('$username', '$email', '$password', 'user') ";
    
                    $conn->exec($newUser);
                    header('location: login.php');
                    // pour afficher un message sur login.php qui dite "vous ètez bien Inscrit"
                    $_SESSION['user_inscrit'] = $username;
                    sleep(1);
                } else {
                    $_SESSION["user_exist"] = $email;
                    header("location: login.php");
                }
                
                // echo "user ajouter" ;

            } catch(PDOException $e) {
                // echo "Error : " . $e->getMessage();
            }
            
            
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