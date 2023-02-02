<?php 
    include "../../config.php";
    include $BlogPathInclude."model.php";
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
        require_once($BlogPathInclude."logout.php");
    }

    // delete user
    if(isset($_GET["delete"])) {
        $userId = $_GET["delete"];
        $usersModel->deleteById($userId, $usersModel->getTableName());
        header("location:".$_SERVER['PHP_SELF']);
        exit();
    }

    // vérifier si vous avez bien créez un nouvelle utlisateur
    if(isset($_SESSION["user_bien_inscrit"])) :?>
        <script>
            alert("<?php echo $_SESSION['login']->username?> vous aves bien créez l'utilisateur <?php echo $_SESSION['user_bien_inscrit']?>")
        </script>
        <?php unset($_SESSION["user_bien_inscrit"])?>
    <?php endif ?>
<?php ?>

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
                    <h2 class="title-panel-page">manage users</h2> 
                    <?php if(!empty($users)) :?>
                        <table>
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>username</th>
                                    <th>role</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0; isset($users[$i]); $i++) :?>
                                    <tr>
                                        <td><?= $users[$i]['id'] ?></td>
                                        <td><?= htmlspecialchars($users[$i]['username']) ?></td>
                                        <td><?= htmlspecialchars($users[$i]['role']) ?></td>
                                        <td class="action-content">
                                        <ul class="flex-r">
                                            <li><a href="" class="first-action">edit</a></li>
                                            <li><a href="?delete=<?php echo $users[$i]['id']?>" class="second-action">delete</a></li>
                                        </ul>
                                    </td>
                                    </tr>
                                <?php endfor ?>
                            </tbody>
                        </table>
                    <?php else :?>
                        <p>Aucune utilisateur existe!</p>
                    <?php endif ?>
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