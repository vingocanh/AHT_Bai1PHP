<?php

    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    // include_once 'models/Database.php';
    class CustomerDatabase extends Database{
      
        private $db ;
        public function __construct()
        {
            $this->db = new Database();
        }
        
        // public function singup($name, $userName, $passWord, $email, $status){
        //     $sql = "INSERT INTO account (name, userName, pass, email, status) VALUES ('$name', '$userName', '$passWord', '$email', '$status')";
        //     $this->db->conn->query($sql);
        // }

        public function getList(){
            $sql = "SELECT * FROM customer";
            $this->db->excetue($sql);

            $data= $this->db->getAllData();

            return $data;
        }

        public function getCustomer($id){
            $sql = "SELECT * FROM customer WHERE id = '".$id."'";
            $this->db->excetue($sql);
            $data = $this->db->getData();

            return $data;
        }

        public function addAccount($name, $email, $create_date, $update_date){
            $sql = "INSERT INTO customer (name, email, created_date, updated_date) VALUES ('$name', '$email', '$create_date', '$update_date')";

            return $this->db->excetue($sql);
        }

        public function editAccount($id, $name, $email, $create_date, $update_date){
            $sql = "UPDATE customer  SET name = '$name', email = '$email', created_date ='$create_date', updated_date = '$update_date' WHERE id = '$id'";

            return $this->db->excetue($sql);
        }

        public function deleteAccount($id){
            $sql = "DELETE FROM customer WHERE id = '$id'";
            
            return $this->db->excetue($sql);
        }

        
     
      
    }
?>