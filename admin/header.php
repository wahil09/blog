<?php 
    require_once("../../config.php");
    if(!isset($_SESSION["login"])) {
        header("location: ../index.php");
        exit();
    } else {
        if(isset($_SESSION["login"]->role)) {
            if($_SESSION['login']->role != "admin") {
                header("location: ../users/");
                exit();
            } else {
                if(isset($_GET["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location: ../index.php");
                    exit();
                }
            }
        }
    }
?>
<header class="header-panel flex-r">
    <h1 class="title"><span>Admi</span>n Panel</h1>
    <nav class="nav-panel">
        <ul name="menuPanel" id="menuPanel">
            <li class="menu-box">
                <span id="openMenu"><i class="fa-solid fa-user"></i>wahil chettouf</span>
                <ul id="menu" class="ul-in-ul">
                    <li><a href="<?php echo $BlogPathLien ?>/admin/index.php">Acceuil</a></li>
                    <li><a href="?logout">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>