<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/interface/interfaceOverview.php';
    class CategoryDatabase extends Database implements interfaceOverview{
      
        private $db ;
        // private $result = NULL;
        public function __construct()
        {
            $this->db = new Database();
        }
        
        public function getList(){
            $sql = "SELECT * FROM category";
            $this->db->excetue($sql);

            $data= $this->db->getAllData();
            return $data;
           
        }
        public function getListById($id){}

        public function getCustomer($id){}
        public function add($values){}
        public function edit($values){}
        public function delete($id){}

    }
?>