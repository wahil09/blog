<?php
    class Connection {
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
                $this->db = new PDO("mysql:host=".$this->severname."; dbname=".$this->dbname."; charset=utf8",$this->user, $this->pass);
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

        public function replaceQuote($text) {
            $singleQuote = str_replace("'", "\'", $text);
            $result = str_replace('"', '\"', $singleQuote);
            return $result;
        }
    }

    class ModelUsers extends Connection {
        public function userAlreadyRegistered($email, $password) {
            $request = $this->db->prepare("SELECT * FROM users WHERE password=:password &&email=:email");
            $request->bindValue("email", $email);
            $request->bindValue("password", $password);
            $request->execute();
            return $request->fetchObject(); // return un object s'il exist ou rien s'il n'est pas inscrit déja
        }   

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
                $username = $this->replaceQuote($username);
                $email = $this->replaceQuote($email);
                $password = $this->replaceQuote($password);
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

    class ModelCategories extends Connection {
        public function isExist($category_name) {
            $sth = $this->db->prepare("SELECT * FROM categories WHERE categoryName = :categoryName");
            $sth->bindValue("categoryName", $category_name);
            $sth->execute();
            return empty($sth->fetch());
        }

        public function tableIsEmpty() {
            $sth = $this->db->query("SELECT categoryName FROM categories");
            return empty($sth->fetch());
        }
        // ------------ Getters -------------
        function getCategories() {
            $sth = $this->db->prepare("SELECT categoryName FROM categories");
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCategoryId($categoryName) {
            $sth = $this->db->prepare("SELECT id FROM categories WHERE categoryName= :categoryName");
            $sth->bindValue("categoryName", $categoryName);
            $sth->execute();
            return $sth->fetchObject()->id;
        }

        // ------------- Setters ------------- 
        function setCategories($category_name, $userId) {
            // check if categorie exist
            if($this->isExist($category_name)) {
                $category_name = $this->replaceQuote($category_name);
                $new_category = "INSERT INTO categories(categoryName, userId) VALUES('$category_name', '$userId')";
                $this->db->exec($new_category);
                // pour afficher un message sur categories.php qui dit "categorie ajouter !"
                $_SESSION['category_ajouter'] = $category_name;
                header("location: categories.php");
                exit();
            } else {
                $_SESSION["category_exist"] = $this->replaceQuote($category_name);
                header("location: categories.php");
                exit();
            }
            
        }
    }

    class ModelPosts extends Connection {
        public function isExist($postTitle, $postUserId, $postContent) {
            $check = $this->db->prepare("SELECT * FROM posts WHERE userId=:userId && postTitle=:postTitle && postContent=:postContent");
            $check->bindValue("postTitle", $postTitle);
            $check->bindValue("postContent", $postContent);
            $check->bindValue("userId", $postUserId);
            $check->execute();
            return !empty($check->fetch());
        }

        public function imageExist($postImage) {
            $check = $this->db->prepare("SELECT postImage FROM posts WHERE postImage=:postImage");
            $check->bindValue("postImage", $postImage);
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
            $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
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

        public function getMyPosts($userId) {
            $sth = $this->db->prepare("SELECT * FROM posts WHERE id= :userId");
        }

        // ------------- Setters ------------- 
        public function setPost($postTitle, $postCat, $postImage, $postContent, $postAuthor, $postUserId, $postCategoryId) {
            if(!$this->isExist($postTitle, $postUserId, $postContent)) {
                // replace all single with \' a cause d'error if insert ex: $postContent -> j'habite ici user l'insert '$postContent' => 'j'habite' <- error
                $postTitle = $this->replaceQuote($postTitle);
                $postCat = $this->replaceQuote($postCat);
                $postImage = $this->replaceQuote($postImage);
                $postContent = $this->replaceQuote($postContent);
                $postAuthor = $this->replaceQuote($postAuthor);
                $newPost = "INSERT INTO posts(postTitle, postCat, postImage, postContent, postAuthor, userId, categoryId) VALUES('$postTitle', '$postCat', '$postImage', '$postContent', '$postAuthor', '$postUserId', '$postCategoryId')";
                $this->db->exec($newPost);
                $_SESSION["post-partager"] = true;
            } else {
                $_SESSION["post-partager"] = false;
            }
        }
    }
?>
