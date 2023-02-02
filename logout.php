<?php
    session_unset();
    session_destroy();
    header("location: ".$BlogPathLien."index.php");
    exit();
?>