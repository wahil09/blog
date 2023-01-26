<header>
    <div class="container flex-r">
        <?php if(isset($_SESSION["role"])) :?>
            <div class="logo-box">
                <h1><?php echo htmlspecialchars($_SESSION['user']) ?></h1>
            </div>
            <!-- Config de l'admin -->
            <?php if($_SESSION["role"] == "admin") :?>
            <!-- bar du navigation pour les grand écrans -->
            <nav>
                <ul class="menu flex-r">
                    <li><a href="index.php">Acceuil</a></li>
                    <li><a href="?messages">Messages</a></li>
                    <li><a href="afficher_users.php">Users</a></li>
                    <li><a href="categories.php">Categories</a></li>
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
                    <li><a href="afficher_users.php">Users</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="?logout">Logout<i style="padding-left: 10px;" class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
                </ul>
            </div>
            <!-- Config de l'utilisateur -->
            <?php elseif($_SESSION['role'] == "user") :?>
                <!-- bar du navigation pour les grand écrans -->
                <nav>
                    <ul class="menu flex-r">
                        <li><a href="index.php">Acceuil</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li class="li-article"><span>Articles</span>
                            <ul class="last-ul">
                                <li class="last-li"><a href="new_post.php">new post</a></li>
                                <li class="last-li"><a href="#">mes articles</a></li>
                            </ul>
                        </li>
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
                        <li class="li-article"><span>Articles</span>
                            <ul class="last-ul">
                                <li class="last-li"><a href="new_post.php">new post</a></li>
                                <li class="last-li"><a href="#">mes articles</a></li>
                            </ul>
                        </li>
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