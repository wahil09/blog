<?php 
    session_start();
    if(isset($_SESSION["user"], $_SESSION["role"])) {
        if($_SESSION["role"] == "user") {
            header("location: users/index.php");
        } else {
            header("location: admin/index.php");
        }
    }
    if(isset($_GET["plus-info"])) {
        
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <?php include "head.php" ?>
    <body id="body">
        <?php include "header.php" ?>
        <main class="posts-content">
            <div class="container">
                <section class='posts'>
                    <article class="post">
                        <div class="post-image">
                            <img src="assets/img/image-1.jpg" alt=''>
                        </div>
                        <div class="post-title">
                            <h3>Post Title</h3>
                        </div>
                        <div class="post-details">
                            <p class="post-info">
                                <span><i class="fa-solid fa-user"></i>Wahil Chettouf</span>
                                <span><i class="fa-solid fa-calendar-days"></i>14/01/2023</span>
                                <span><i class="fa-sharp fa-solid fa-tags"></i>Blog</span>
                            </p>
                            <p class="post-description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ad ducimus tenetur officiis nulla? Neque sapiente distinctio exercitationem. Sint laborum consequatur, temporibus obcaecati architecto incidunt delectus a fugit quis minima.</p>
                            <a href="?plus-info" class="btn-custom" >Lire Plus</a>
                        </div>
                    </article>
                    <article class="post">
                        <div class="post-image">
                            <img src="assets/img/image-2.jpg" alt=''>
                        </div>
                        <div class="post-title">
                            <h3>Post Title</h3>
                        </div>
                        <div class="post-details">
                            <p class="post-info">
                                <span><i class="fa-solid fa-user"></i>Wahil Chettouf</span>
                                <span><i class="fa-solid fa-calendar-days"></i>14/01/2023</span>
                                <span><i class="fa-sharp fa-solid fa-tags"></i>Blog</span>
                            </p>
                            <p class="post-description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ad ducimus tenetur officiis nulla? Neque sapiente distinctio exercitationem. Sint laborum consequatur, temporibus obcaecati architecto incidunt delectus a fugit quis minima.</p>
                            <a href="?plus-info" class="btn-custom" >Lire Plus</a>
                        </div>
                    </article>
                    <article class="post">
                        <div class="post-image">
                            <img src="assets/img/image-3.jpg" alt=''>
                        </div>
                        <div class="post-title">
                            <h3>Post Title</h3>
                        </div>
                        <div class="post-details">
                            <p class="post-info">
                                <span><i class="fa-solid fa-user"></i>Wahil Chettouf</span>
                                <span><i class="fa-solid fa-calendar-days"></i>14/01/2023</span>
                                <span><i class="fa-sharp fa-solid fa-tags"></i>Blog</span>
                            </p>
                            <p class="post-description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ad ducimus tenetur officiis nulla? Neque sapiente distinctio exercitationem. Sint laborum consequatur, temporibus obcaecati architecto incidunt delectus a fugit quis minima.</p>
                            <a href="?plus-info" class="btn-custom" >Lire Plus</a>
                        </div>
                    </article>
                </section>

                <div class="sidebar">
                    <div class="row categories flex-c">
                        <h2>Category</h2>
                        <ul class="flex-c">
                            <li><a href="#"><span><i class="fa-sharp fa-solid fa-tags"></i>bloger</span></a></li>
                            <li><a href="#"><span><i class="fa-sharp fa-solid fa-tags"></i>youtube</span></a></li>
                            <li><a href="#"><span><i class="fa-sharp fa-solid fa-tags"></i>tutorials</span></a></li>
                            <li><a href="#"><span><i class="fa-sharp fa-solid fa-tags"></i>android</span></a></li>
                            <li><a href="#"><span><i class="fa-sharp fa-solid fa-tags"></i>informatique</span></a></li>
                        </ul>
                    </div>
                    <div class="row last-posts flex-c">
                        <h2>dernier posts</h2>
                        <ul class="flex-c">
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-1.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-2.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                            <li class="last-post">
                                <a href="#" class="last-post">
                                    <span class="img-last-post"><img src="assets/img/image-3.jpg" alt=""></span>
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, culpa!</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        <?php include "footer.php" ?>
        <script src="assets/js/script.js"></script>
    </body>
</html>