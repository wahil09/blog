<footer>
    <div class="container flex-r">
        <p>&copy; All rights reserved </p>
        <?php if(isset($_SESSION["role"])) :?>
            <ul class="flex-r">
                <li><a href="#"><i class="fa-brands fa-github"></i><?php echo $_SESSION['user'] ?>-github</a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin"></i><?php echo $_SESSION['user'] ?>-linkedin</a></li>
            </ul>
            <!-- Config de l'admin -->
            <?php if($_SESSION["role"] == "admin") :?>
                <!-- rien pour le moment -->
                <!-- Config de l'utilisateur -->
            <?php elseif($_SESSION['role'] == "user") :?>
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
