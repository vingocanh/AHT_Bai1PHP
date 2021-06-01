<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    class ProducDatabase extends Database{
      
        private $db ;
        // private $result = NULL;
        public function __construct()
        {
            $this->db = new Database();
        }
        
        public function getList(){
            $sql = "SELECT * FROM product";
            $this->db->excetue($sql);

            $data= $this->db->getAllData();
            return $data;
           
        }

    }
?>