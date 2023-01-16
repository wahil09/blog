<?php
    class connexion {
        public $severname;
        public $user;
        public $pass;
        public $dbname;
        function __construct() {
            $this->severname = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->dbname = "wahil";
        }
        function conn() {
            try {
                $conn = new PDO("mysql:host=".$this->severname."; dbname=".$this->dbname,$this->user, $this->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        function getUsers() {
            $sth = $this->conn()->prepare("SELECT id, date_creation, username, email FROM users WHERE role != 'admin'");
            $sth->execute();
            if(!empty($sth)) {
                $categories = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $categories;
            } else {
                echo "Users table vide";
            }
        }

        function setUser($categorie_name) {
            $sth = $this->conn()->prepare("SELECT * FROM users WHERE categorie_name = :categorie_name");
            $sth->bindValue("categorie_name", $categorie_name);
            $sth->execute();
            // check if categorie exist
            if(empty($sth->fetch())) {
                $new_categorie = "INSERT INTO categories(categorie_name) VALUES('$categorie_name')";
                $this->conn()->exec($new_categorie);
                // pour afficher un message sur categories.php qui dit "categorie ajouter !"
                $_SESSION['categorie_ajouter'] = $categorie_name;
                header("location: categories.php");
            } else {
                $_SESSION["categorie_exist"] = $categorie_name;
                header("location: categories.php");
            }
            
        }

    }

?>