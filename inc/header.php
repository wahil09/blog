<?php require_once("config.php")?>
<header>
    <div class="container flex-r">
        <?php if(isset($_SESSION["login"])) :?>
            <div class="logo-box">
                <h1><?php echo htmlspecialchars($_SESSION["login"]->username) ?></h1>
            </div>
            <!-- Config de l'admin -->
            <?php if($_SESSION["login"]->role == "admin") :?>
            <!-- bar du navigation pour les grand écrans -->
            <nav>
                <ul class="menu flex-r">
                    <li><a href="<?php echo $adminPathLien?>index.php">Acceuil</a></li>
                    <li><a href="<?php echo $adminPathLien?>posts_manager/manage_posts.php">Dashboard</a></li>
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
                    <li><a href="<?php echo $adminPathLien?>index.php">Acceuil</a></li>
                    <li><a href="<?php echo $adminPathLien?>posts_manager/manage_posts.php">Dashboard</a></li>
                    <li><a href="?logout">Logout<i style="padding-left: 10px;" class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
                </ul>
            </div>
            <!-- Config de l'utilisateur -->
            <?php elseif($_SESSION["login"]->role == "user") :?>
                <!-- bar du navigation pour les grand écrans -->
                <nav>
                    <ul class="menu flex-r">
                        <li><a href="index.php">Acceuil</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="profile.php">Profile</a></li>
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
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="?logout">Logout<i style="padding-left: 10px;" class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
                    </ul>
                </div>
            <?php endif; ?>
        
        <!-- Pour les visiteurs -->
        <?php else :?>
            <div class="logo-box">
                <h1>Acceuil Page</h1>
            </div>
            <!-- bare du navigation pour les grands écrans -->
            <nav>
                <ul class="menu flex-r">
                    <li><a href="index.php">Acceuil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="register.php">Inscription</a></li>
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
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="register.php">Inscription</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</header>