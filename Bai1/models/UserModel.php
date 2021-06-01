<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    class UserDatabase extends Database{
      
        private $db ;
        // private $result = NULL;
        public function __construct()
        {
            $this->db = new Database();
        }
        
        public function singup($name, $email, $passWord, $level){
            $sql = "INSERT INTO user (name, email, passWord, level) VALUES ('$name', '$email', '$passWord', '$level')";
            return $this->db->excetue($sql);
        }

        public function Login($email, $passWord){
            $sql = "SELECT * FROM user WHERE email = '$email' AND passWord= '$passWord'";
		
		    return $this->db->excetue($sql);
        }

        public function checkExists($email) {
            $sql = "SELECT * FROM user WHERE email = '$email'";
		
		    return $this->db->excetue($sql);
        }

        public function changePassWord($id, $passWord){
            $sql = "UPDATE user  SET passWord= '$passWord' WHERE id = '$id'";

            return $this->db->excetue($sql);
        }
       
      
    }
?>