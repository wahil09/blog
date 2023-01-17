<?php
    class Connexion {
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
                // On ferme la connexion
                return $conn;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    class ModelUsers extends Connexion {
        function getUsers() {
            $sth = $this->conn()->prepare("SELECT id, date_creation, username, email FROM users WHERE role != 'admin'");
            $sth->execute();
            if(!empty($sth)) {
                $categories = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $categories;
            } 
        }

        function setUser($username, $email, $password) {
            $sth = $this->conn()->prepare("SELECT * FROM users WHERE email = :email");
            $sth->bindValue("email", $email);
            $sth->execute();
            // check if categorie exist
            if(empty($sth->fetch())) {
                $newUser = "INSERT INTO users(username, email, password, role) VALUES('$username', '$email', '$password', 'user') ";
                $this->conn()->exec($newUser);
                // pour afficher un message sur login.php qui dit "categorie ajouter !"
                $_SESSION['user_inscrit'] = $username;
                header("location: login.php");
            } else {
                $_SESSION["user_exist"] = $email;
                header("location: login.php");
            }
            // On ferme la connexion
            $conn = null;
        }
    }

    class ModelCategories extends Connexion {
        function getCategories() {
            $sth = $this->conn()->prepare("SELECT categoryName FROM categories");
            $sth->execute();
            if(!empty($sth)) {
                $categories = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $categories;
            } else {
                echo "categories table vide";
            }
        }

        function setCategories($categorie_name) {
            $sth = $this->conn()->prepare("SELECT * FROM categories WHERE categoryName = :categoryName");
            $sth->bindValue("categoryName", $categorie_name);
            $sth->execute();
            // check if categorie exist
            if(empty($sth->fetch())) {
                $new_categorie = "INSERT INTO categories(categoryName) VALUES('$categorie_name')";
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

    class ModelPosts extends Connexion {
        public function isExist($postTitle, $postUserId, $postContent) {
            $check = $this->conn()->prepare("SELECT * FROM posts WHERE userId=:userId && postTitle=:postTitle && postContent=:postContent");
            $check->bindValue("postTitle", $postTitle);
            $check->bindValue("postContent", $postContent);
            $check->bindValue("userId", $postUserId);
            $check->execute();
            
            return !empty($check->fetch());
        }
        
        function getPosts() {
            $sth = $this->conn()->prepare("SELECT * FROM posts");
            $sth->execute();
            if(!empty($sth)) {
                $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $posts;
            }
        }

        public function setPost($postTitle, $postCat, $postContent, $postAuthor, $postUserId) {
            $newPost = "INSERT INTO posts(postTitle, postCat, postContent, postAuthor, userId) VALUES('$postTitle', '$postCat', '$postContent', '$postAuthor', '$postUserId')";
            $this->conn()->exec($newPost);
        } 
    }
?>
