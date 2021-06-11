<?php

    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    require_once 'interface/interfaceOverview.php';
    class CustomerDatabase extends Database implements interfaceOverview{
      
        private $db ;
        public function __construct()
        {
            $this->db = new Database();
        }

        public function getList(){
            $sql = "SELECT * FROM customer";
            $this->db->excetue($sql);
            $data= $this->db->getAllData();
            return $data;
        }

        public function getListById($id){}

        public function getCustomer($id){
            $sql = "SELECT * FROM customer WHERE id = '".$id."'";
            $this->db->excetue($sql);
            $data = $this->db->getData();

            return $data;
        }

        public function add($values){
            $sql = "INSERT INTO customer (name, email, created_date, updated_date) VALUES ('".$values['name']."', '".$values['email']."', '".$values['created_date']."', '".$values['updated_date']."') ";

            return $this->db->excetue($sql);
        }

        public function edit($values){
            $sql = "UPDATE customer SET name = '".$values['name']."', email = '".$values['email']."', created_date ='".$values['created_date']."', updated_date = '".$values['updated_date']."' WHERE id='".$values['id']."' ";
            // print_r($sql);
            // exit;
            return $this->db->excetue($sql);
        }

        public function delete($id){
            $sql = "DELETE FROM customer WHERE id = '".$id."'";
            
            return $this->db->excetue($sql);
        }

        
     
      
    }
?>