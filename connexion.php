<?php
    session_start();
    $error = false;
    if(isset($_POST["submit"])) {
        if(isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST['password'];
            if(!empty($email) && !empty($password)) {
                $servername = "localhost";
                $user = "root";
                $passw = "";
                $dbname = "wahil";
                try {
                    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $user, $passw);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sth = $conn->prepare("SELECT * FROM users WHERE password= :password &&email= :email");
                    $sth->bindValue(':email', $email);
                    $sth->bindValue(':password', $password);
                    $sth->execute();
                    $response = $sth->fetchObject();

                    if(!empty($response)) {
                        if($response->role == "user") {
                            $_SESSION["user"] = $response->username;
                            $_SESSION["role"] = $response->role;
                            $_SESSION["userId"] = $response->id;
                            header("location: users/index.php");
                        } elseif($response->role == "admin") {
                            $_SESSION["user"] = $response->username;
                            $_SESSION["role"] = $response->role;
                            $_SESSION["adminId"] = $response->id;
                            header("location: admin/index.php");
                        }
                    } else {
                        header("location: login.php");
                        $_SESSION["error_login_user"] = $email;
                    }

                    // foreach($sth->fetch() as $row) {
                    //     echo $row['email'], count($sth->fetchAll());
                    // }


                    // if(!empty($sth->fetchAll())) {

                    // } else {
                    //     echo "le table est vide";
                    // }


                } catch (PDOException $e) {
                    echo "Erreur : " .$e->getMessage();
                }
            } else {
                $error = true;
            }
        }
    }

    if($error) {
        $_SESSION['error'] = $error;
        header("location: login.php");
    }
?>