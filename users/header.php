
<header>
    <div class="container flex-r">
        <div class="logo-box">
            <h1><?php echo $_SESSION['user'] ?></h1>
        </div>
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
                <li><a href="contact.php">Contact</a></li>
                <li class="li-article"><span>Articles</span>
                    <ul class="last-ul">
                        <li class="last-li"><a href="new_post.php">new post</a></li>
                        <li class="last-li"><a href="#">mes articles</a></li>
                    </ul>
                </li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="categories.php">Categories</a></li>

                <li><a href="?logout">Logout<i style="padding-left: 10px;" class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </div>
    </div>
</header>