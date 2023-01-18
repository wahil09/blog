<?php 
    session_start();
    include "../model.php";
    
    $usersModel = new ModelUsers();
    if(!isset($_SESSION["user"], $_SESSION["role"])) {
        header("location: ../login.php");
        exit();
    } else {
        if($_SESSION['role'] != "admin") {
            header("location: ../users/index.php");
            exit();
        }
    }

    if(isset($_GET["logout"])) {
        session_destroy();
        header("location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
    <head>
        <style>
            header .container .menu a:hover {
                color: black;
            }
        </style>
    </head>
<body id="body">
    <header style="background-image: linear-gradient(to left top, #B952C2, #6C56CB);">
        <div class="container flex-r">
            <div class="logo-box">
                <h1><?php echo $_SESSION['user'] ?></h1>
            </div>
            <!-- bar du navigation pour les grand écrans -->
            <nav>
                <ul class="menu flex-r">
                <li><a href="index.php">Acceuil</a></li>
                    <li><a href="?messages">Messages</a></li>
                    <li><a href="?users">Users</a></li>
                    <li><a href="?logout">Logout<i style="padding-left: 10px;" class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
                </ul>
            </nav>
            <div class="nav-bar-phone" id="menuPhoneBox">
                <div class="bars flex-c">
                    <span class="bar top"></span>
                    <span class="bar millieu"></span>
                    <span class="bar bottom"></span>
                </div>
                <ul class="menu-phone flex-c" id="menuPhone">
                <li><a href="index.php">Acceuil</a></li>
                    <li><a href="?messages">Messages</a></li>
                    <li><a href="?users">Users</a></li>
                    <li><a href="?logout">Logout<i style="padding-left: 10px;" class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <section class="user-table-box">
            <div class="container flex-c">
                <h2>User Table</h2>
                <table class="table-users">
                    <thead>
                        <tr>
                            <?php 
                            $width_screen = 0;
                            $height_screen = 0;
                            if(isset($_COOKIE['sw'])) {
                                $width_screen = $_COOKIE['sw'];
                            } 
                            
                            if(isset($usersModel->getUsers()[0])) {
                                if($width_screen > 768) {
                                    foreach($usersModel->getUsers()[0] as $key => $value) {
                                        echo "
                                                <td>$key</td>
                                            ";
                                    }
                                    echo "<td>option</td>";
                                } else {
                                    for($i=0; isset($usersModel->getUsers()[$i]); $i++) { 
                                        foreach($usersModel->getUsers()[0] as $key => $value) {
                                            echo "
                                                    <td>$key</td>
                                                ";
                                        }
                                        echo "<td>option</td>";
                                    }
                                }
                            } else {
                                echo "<h2 class='c-black'>Users Not Found !</h2>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            for($i=0; isset($usersModel->getUsers()[$i]); $i++) {
                                echo "<tr>";
                                $user_id = 0;
                                foreach($usersModel->getUsers()[$i] as $key => $value) {
                                    $user_id = $usersModel->getUsers()[$i]['id'];
                                    echo "
                                            <td>$value</td>
                                        ";
                                }
                                echo "<td class='delete-user-box'><a href='?delete=$user_id' name='delete'>Delete</a></td>";
                            }
                            // On ferme la connexion
                            $usersModel->closeConnection();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <?php include "footer.php" ?>
    <script src="../assets/js/script.js"></script>
    
</body>
</html>