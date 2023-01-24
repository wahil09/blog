
<?php if(isset($_SESSION["role"])) :?>
    <?php if($_SESSION["role"] == "admin") :?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="wahli chettouf">
        <title><?php echo $_SESSION['role']?></title>
        <link rel="stylesheet" href="../assets/css/all.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200;300;400;500;600;700;800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap');
            <?php include "../assets/css/style.css" ?>
            <?php include "../assets/css/MQuiry.css" ?>
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="../assets/js/jquery.cookie.js"></script>
        <script type=text/javascript>
            function setScreenHWCookie() {
                $.cookie('sw',window.innerWidth);
                $.cookie('sh',window.innerHeight);
                return true;
            }
            setScreenHWCookie();
        </script>
    <?php elseif($_SESSION['role'] == "user") :?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="wahli chettouf">
        <title><?php echo $_SESSION['role']?></title>
        <link rel="stylesheet" href="../assets/css/all.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200;300;400;500;600;700;800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap');
            <?php include "../assets/css/style.css" ?>
            <?php include "../assets/css/MQuiry.css" ?>
        </style>
    <?php endif; ?>

<?php else :?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="wahli chettouf">
        <title>index</title>
        <link rel="stylesheet" href="assets/css/all.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200;300;400;500;600;700;800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap');
            <?php include "assets/css/style.css" ?>
            <?php include "assets/css/MQuiry.css" ?>
        </style>
    </head>
<?php endif; ?>