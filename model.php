<?php
    class Connexion {
        public $severname;
        public $user;
        public $pass;
        public $dbname;
        public $db;
        function __construct() {
            $this->severname = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->dbname = "wahil";
            try {
                $this->db = new PDO("mysql:host=".$this->severname."; dbname=".$this->dbname,$this->user, $this->pass);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->db;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function closeConnection() {
            // On ferme la connexion
            $this->db = null;
            return $this->db;
        }
    }

    class ModelUsers extends Connexion {
        // ------------ Getters ------------
        function getUsers() {
            $sth = $this->db->prepare("SELECT id, inscriptionDate, username, email FROM users WHERE role != 'admin'");
            $sth->execute();
            if(!empty($sth)) {
                $categories = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $categories;
            } 
        }


        // ------------- Setters ------------- -
        function setUser($username, $email, $password) {
            $sth = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $sth->bindValue("email", $email);
            $sth->execute();
            // check if categorie exist
            if(empty($sth->fetch())) {
                $newUser = "INSERT INTO users(username, email, password, role) VALUES('$username', '$email', '$password', 'user') ";
                $this->db->exec($newUser);
                // pour afficher un message sur login.php qui dit "categorie ajouter !"
                $_SESSION['user_inscrit'] = $username;
                header("location: login.php");
                exit();
            } else {
                $_SESSION["user_exist"] = $email;
                header("location: login.php");
                exit();
            }
        }
    }

    class ModelCategories extends Connexion {
        // ------------ Getters -------------
        function getCategories() {
            $sth = $this->db->prepare("SELECT categoryName FROM categories");
            $sth->execute();
            if(!empty($sth)) {
                $categories = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $categories;
            } else {
                echo "categories table vide";
            }
        }

        // ------------- Setters ------------- 
        function setCategories($categorie_name) {
            $sth = $this->db->prepare("SELECT * FROM categories WHERE categoryName = :categoryName");
            $sth->bindValue("categoryName", $categorie_name);
            $sth->execute();
            // check if categorie exist
            if(empty($sth->fetch())) {
                $new_categorie = "INSERT INTO categories(categoryName) VALUES('$categorie_name')";
                $this->db->exec($new_categorie);
                // pour afficher un message sur categories.php qui dit "categorie ajouter !"
                $_SESSION['categorie_ajouter'] = $categorie_name;
                header("location: categories.php");
                exit();
            } else {
                $_SESSION["categorie_exist"] = $categorie_name;
                header("location: categories.php");
                exit();
            }
            
        }
    }

    class ModelPosts extends Connexion {
        public function isExist($postTitle, $postUserId, $postContent) {
            $check = $this->db->prepare("SELECT * FROM posts WHERE userId=:userId && postTitle=:postTitle && postContent=:postContent");
            $check->bindValue("postTitle", $postTitle);
            $check->bindValue("postContent", $postContent);
            $check->bindValue("userId", $postUserId);
            $check->execute();
            
            return !empty($check->fetch());
        }

        public function tableIsEmpty() {
            $sth = $this->db->prepare("SELECT * FROM posts");
            $sth->execute();
            return !empty($sth);
        }
        
        // ------------ Getters --------------
        function getPosts() {
            $sth = $this->db->prepare("SELECT * FROM posts");
            $sth->execute();
            if(!empty($sth)) {
                $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $posts;
            }
        }

        public function getPostSelected($postId) {
            if($this->tableIsEmpty()) {
                $postSelected = $this->db->prepare("SELECT * FROM posts WHERE id= :postID");
                $postSelected->bindValue("postID", $postId);
                $postSelected->execute();
                if(!empty($postSelected)) {
                    return $postSelected->fetch();
                }
            }
        }

        // ------------- Setters ------------- 
        public function setPost($postTitle, $postCat, $postImage, $postContent, $postAuthor, $postUserId) {
            $newPost = "INSERT INTO posts(postTitle, postCat, postImage, postContent, postAuthor, userId) VALUES('$postTitle', '$postCat', '$postImage', '$postContent', '$postAuthor', '$postUserId')";
            $this->db->exec($newPost);
        } 
    }
?>
