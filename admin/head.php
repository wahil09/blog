<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="wahil chettouf">
    <meta name="description" content="admin panel">
    <title>Dashboard</title>
    <style>
        <?php
            // vérifier quelle page est ouvert maintenent
            if(explode('/', $_SERVER["PHP_SELF"])[3] != "index.php") {
                require_once("../assets/css/style.css");
                require_once("../assets/css/MQuiry.css");
                require_once("../../assets/css/all.css");
            } else {
                require_once("assets/css/style.css");
                require_once("assets/css/MQuiry.css");
                require_once("../assets/css/all.css");
            }
        ?>
    </style>
</head>