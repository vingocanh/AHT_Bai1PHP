<?php

// session_start();
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/CustomerModel.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/UserModel.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/CategoryModel.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/config/session.php';
    class CustomerController{

        private $db;
        private $dbUser;
        private $dbCate;
        public $tam = array();
        public function __construct(){
            $this->db=new CustomerDatabase();
            $this->dbUser = new UserDatabase();
            $this->dbCate= new CategoryDatabase();
        }
        public function Customer(){
            // echo 'Vao';
            // exit;
            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }else{
                $action = '';
            }
            switch($action){
                case 'add':
                    // echo 'adad';
                    // exit;
                    $this->addCustomer();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/add.php';
                    
                    break;

                case 'edit':
                    $result = $this->editCustomer();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/edit.php';
         
                    break;    
                    
                case 'delete':
                    $this->deleteCustomer();
                    break;

                case 'out':
                    $this->logOut();  
                    header('Location: /php/AHT/Bai1/index.php?action=login');
                   
                    break;

                case 'home':
                    $tams = $this->getName();
                    //header('Location: /php/AHT/Bai1/index.php?action=home');
                    //require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/list.php';
                        
                    break;

                case 'contact':
                    $tams = $this->getName();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/contact.php';
                    break;
    
                case 'list':
                    $results = $this->listCustomer();
                    $tams = $this->getName();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/list.php';
                    
                    break;
                        
                case 'introduce':
                    require_once 'views/client/page/introduce.php';
                    break;
                
                case 'newspage':
                    $tams = $this->getName();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/newspage.php';
                    break;
                default:   
                    $tams = $this->getName();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/home.php';
                    break;
            }
        }

     
        public function listCustomer(){
            $datas= $this->db->getList();
            
            return $datas;
        }

        public function addCustomer(){
            if(isset($_POST['btnThem'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $create_date = $_POST['created_date'];
                $update_date = $_POST['updated_date'];

                if($this->db->addAccount($name, $email, $create_date, $update_date)){
                    //require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/list.php';
                }
                // else{
                //     $this->tam = 'add_failed_customers';
                // }

                header('Location: ?action=list');
            }
        }

        public function editCustomer(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $data = $this->db->getCustomer($id);

                if(!empty($_POST)){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $create_date = $_POST['created_date'];
                    $update_date = $_POST['updated_date'];
    
                    if($this->db->editAccount($id, $name, $email, $create_date, $update_date)){
                        $this->tam = 'edit_successful_customers';
                    }
                    // else{
                    //     $this->tam = 'add_failed_customers';
                    // }
                    header('Location: ?action=list');
                    //header('Location: views/admin/page/home.php');
                }
            }

            return $data;
        }

        public function deleteCustomer(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $this->db->deleteAccount($id);

                // print_r($id);
                // exit;
                header('Location: ?action=list');
            }
        }

        public function logOut(){
            if (isset($_GET['out'])) {
                // echo 'Hủy Session';
                // exit;
                $tam = "sessionUsers";
                SessionUser::huySession($tam);
                
                // header('Location: ?action=login');
               
            }
        }
        public function getName(){
            $datas= $this->dbCate->getCategory();
            
            return $datas;
        }
    }
?>