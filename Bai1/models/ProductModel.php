<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/Database.php';
    require_once 'interface/interfaceOverview.php';
    class ProducDatabase extends Database implements interfaceOverview{
      
        private $db ;
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

        public function getCustomer($id){
            $sql = "SELECT * FROM product WHERE id ='$id' OR categoryID ='$id'";

            $this->db->excetue($sql);
            $data = $this->db->getData();

            return $data;
        }

        public function getListById($id){
            $sql = "SELECT * FROM product WHERE categoryID ='$id' OR categoryID='$id'";

            $this->db->excetue($sql);
            $data = $this->db->getAllData();

            return $data;
        }
        public function add($values){

        }
        public function edit($values){
            $sql = "UPDATE product  SET name= '".$values['name']."', introduce='".$values['introduce']."', img = '".$values['img']."', categoryID ='".$values['categoryID']."', CreateDate ='".$values['created_date']."', CreateBy='".$values['createdBy']."' WHERE id = '".$values['id']."'";
            // printf($sql);
            // exit;
          return $this->db->excetue($sql);
        }

        public function delete($id){
            $sql = "DELETE FROM product WHERE id = '$id'";
            
            return $this->db->excetue($sql);
        }

    }
?>