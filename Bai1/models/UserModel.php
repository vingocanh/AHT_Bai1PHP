<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    require_once 'interface/interfaceOverview.php';
    class UserDatabase extends Database implements interfaceOverview{
      
        private $db ;
        // private $result = NULL;
        public function __construct()
        {
            $this->db = new Database();
        }

        public function getListById($values){
            $sql = "SELECT * FROM user WHERE email = '".$values['adminEmail']."' AND passWord= '".md5($values['adminPassWord'])."'";
		
		    return $this->db->excetue($sql);
        }

        public function getList(){}
       
         //check email trong csdl
        public function getCustomer($email){
            $sql = "SELECT * FROM user WHERE email = '$email'";
		
            return $this->db->excetue($sql);
        }
        //đăng ký tài khoản
        public function add($values){
            $sql = "INSERT INTO user (name, email, passWord, level) VALUES ('".$values['name']."', '".$values['email']."', '".md5($values['passWord'])."', '".$values['level']."')";
            return $this->db->excetue($sql);

        }
        public function edit($values){}
        public function delete($id){}
       
      
    }
?>