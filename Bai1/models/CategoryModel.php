<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    class CategoryDatabase extends Database{
      
        private $db ;
        // private $result = NULL;
        public function __construct()
        {
            $this->db = new Database();
        }
        
        public function getCategory(){
            $sql = "SELECT * FROM category";
            $this->db->excetue($sql);

            $data= $this->db->getAllData();
            return $data;
           
        }

    }
?>