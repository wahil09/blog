<?php 
    include "../../model.php";
    $usersModel = new ModelUsers();
    $users = $usersModel->getUsers();
    if(!isset($_SESSION["login"])) {
        header("location: ../../index.php");
        exit();
    } else {
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION['login']->role != "admin") {
                header("location: ../../users/");
                exit();
            } else {
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location: ../../index.php");
                    exit();
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
<?php require_once("../head.php")?>
<body>
    <div class="content">
        <?php require_once("../header.php");?>
        <main class="container-panel">
            <?php require_once("../side-bare.php")?>
            <section class="box-content-panel">
                <div class="content-panel">
                    <ul>
                        <li><a href="new_post.php" class="btn-panel">add user</a></li>
                        <li><a href="#" class="btn-panel">manage users</a></li>
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
                                        <td><?= $users[$i]['username'] ?></td>
                                        <td><?= $users[$i]['role'] ?></td>
                                        <td class="action-content">
                                        <ul class="flex-r">
                                            <li><a href="" class="first-action">edit</a></li>
                                            <li><a href="" class="second-action">delete</a></li>
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
    <script src="../assets/js/script.js"></script>
</body>
</html>