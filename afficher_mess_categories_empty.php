<?php 
    if (isset($_SESSION["categories_empty"])) {
        if($_SESSION["categories_empty"]) {
            echo "<script>
                    var paraEmptyCategories = document.querySelector('#paraEmptyCategories');
                    paraEmptyCategories.classList.add('afficher');
                </script>";

        } else {
            echo "<script>
                    var paraEmptyCategories = document.querySelector('#paraEmptyCategories');
                    paraEmptyCategories.classList.remove('afficher');
                </script>";
        }
    }
?>