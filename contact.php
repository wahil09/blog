<?php 
    include "inc/config.php";
    session_start();

    if(isset($_SESSION["login"])) {
        if($_SESSION["login"]->role == "user") {
            header("location: ".$BlogPathLien."users/index.php");
            exit();
        } else {
            header("location: ".$BlogPathLien."admin/index.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <?php include $BlogPathInclude."inc/head.php" ?>
    <body id="body">
        <?php include $BlogPathInclude."inc/header.php" ?>
        <main>
            <!-- ***** Contact Us ***** -->
            <section class="contact" id="contact">
                <div class="container">
                    <div class="main-heading flex-c">
                        <h2 class="flex-r">contact us</h2>
                        <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt. 
                        </p>
                    </div>
                    <div class="content flex-r">
                        <form action="#" method="post" class="form flex-c">
                            <input type="text" name="nom" id="name" placeholder="Your Name">
                            <input type="email" name="mail" id="email" placeholder="Your Email">
                            <textarea class="txtarea" id="txtarea" name="txtname" rows="9" maxlength="1000" placeholder="Your Message"></textarea>
                            <input type="submit" value="SEND MESSAGE">
                        </form>
                        <div class="info flex-c">
                            <div class="phone">
                                <h4>get in touch</h4>
                                <span>+00 123.456.789</span>
                                <span>+00 123.456.789</span>
                            </div>
                            <address>
                                <h4>where we are</h4>
                                Awesome Address 17<br>
                                New York, NYC<br>
                                123-4567-890<br>
                                USA
                            </address>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include $BlogPathInclude."inc/footer.php" ?>

        <script src="<?php echo $BlogPathLien?>assets/js/script.js"></script>
    </body>
</html>