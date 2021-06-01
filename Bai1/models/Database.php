<?php
    class Database{
        private $hostName = "localhost:3306";
        private $userName = "root";
        private $passWord = "";
        private $databaseName = "customer_management";

        private $conn = NULL;
        private $result = null;
        // private $result = NULL;
        public function __construct()
        {
            $this->connect();
        }
        public function connect(){
            $this->conn = mysqli_connect ($this->hostName, $this->userName, $this->passWord, $this->databaseName);
            if(!$this->conn){
                echo 'Kết nối thất bại';    
                exit();
            }else{
                mysqli_set_charset($this->conn, "utf8");
            }
            return $this->conn; 
        }
        public function disConnect(){
            if ($this->conn){
                mysqli_close($this->conn);
            }
        }

        public function excetue($sql){
            $this->result = $this->conn->query($sql);

            return $this->result;
        }

        public function getData(){
            if($this->result){
                $data = mysqli_fetch_array($this->result);
            }else{
                $data = 0;
            }

            return $data;
        }

        public function getAllData(){
            if($this->demBanGhi()== 0){
                $data= 0;
            }
            else{   
                $data = [];
                while($row = $this->getData()){
                    $data[] = $row; 
                }
            }
            return $data;
        }

        public function demBanGhi(){
            if($this->result){
                $num = mysqli_num_rows($this->result);
            }else{
                $num = 0;
            }

            return $num;
        }

       
    }
?>