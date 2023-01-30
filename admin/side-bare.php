<div class="side-bare">
    <ul class="side-bare-menu">
        <?php if(explode('/', $_SERVER["PHP_SELF"])[3] == "posts-manager") :?>
            <li><a href="manage_posts.php">manage posts</a></li>
            <li><a href="../users_manager/manage_users.php">manage users</a></li>
            <li><a href="../categories_manager/manage_categories.php">manage categories</a></li>
        <?php elseif(explode('/', $_SERVER["PHP_SELF"])[3] != "users_manager") :?>
            <li><a href="../posts_manager/manage_posts.php">manage posts</a></li>
            <li><a href="manage_users.php">manage users</a></li>
            <li><a href="../categories_manager/manage_categories.php">manage categories</a></li>
        <?php elseif(explode('/', $_SERVER["PHP_SELF"])[3] != "categories_manager") :?>
            <li><a href="../posts_manager/manage_posts.php">manage posts</a></li>
            <li><a href="../users_manager/manage_users.php">manage users</a></li>
            <li><a href="categories_manager.php">manage categories</a></li>
        <?php else :?>
            <li><a href="posts_manager/manage_posts.php">manage posts</a></li>
            <li><a href="users_manager/manage_users.php">manage users</a></li>
            <li><a href="categories_manager/manage_categories.php">manage categories</a></li>
        <?php endif ?>
    </ul>
</div>