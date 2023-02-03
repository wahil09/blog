<?php
    require_once("config.php");
    session_unset();
    session_destroy();
    header("location: ".$BlogPathLien."index.php");
    exit();
?>