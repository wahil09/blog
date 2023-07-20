<footer>
    <div class="container flex-r">
        <p>&copy; All rights reserved </p>
        <?php if(isset($_SESSION["login"])) :?>
            <ul class="flex-r">
                <li><a href="#"><i class="fa-brands fa-github"></i><?php echo htmlspecialchars($_SESSION['login']->username) ?>-github</a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin"></i><?php echo htmlspecialchars($_SESSION['login']->username) ?>-linkedin</a></li>
            </ul>
            <!-- Config de l'admin -->
            <?php if($_SESSION["login"]->role == "admin") :?>
                <!-- rien pour le moment -->
                <!-- Config de l'utilisateur -->
            <?php elseif($_SESSION["login"]->role == "user") :?>
                <!-- rien pour le moment -->
            <?php endif; ?>
        
        <!-- Pour les visiteurs -->
        <?php else :?>
            <ul class="flex-r">
                <li><a href="#"><i class="fa-brands fa-github"></i>compte-github</a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin"></i>compte-linkedin</a></li>
            </ul>
        <?php endif; ?>
    </div>
</footer>
