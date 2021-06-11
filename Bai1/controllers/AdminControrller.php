<?php

// session_start();
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/AminModel.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/UserModel.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/CategoryModel.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/models/ProductModel.php';
    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/config/session.php';
    class AdminController{

        private $db;
        private $dbUser;
        private $dbCate;
        private $dbPro;
        public $tam = array();
        public function __construct(){
            $this->db=new CustomerDatabase();
            $this->dbUser = new UserDatabase();
            $this->dbCate= new CategoryDatabase();
            $this->dbPro= new ProducDatabase();
        }
        public function Admin(){
            // echo 'Vao';
            // exit;
            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }else{
                $action = '';
            }
            switch($action){
                case 'add':
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
                    $tams = $this->getNameGroup();
                    $list = $this->getNewsletterList();
                    $list2 = $this->getListIMGCategory();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/home.php';    
                    //header('Location: /php/AHT/Bai1/index.php?action=home');
                    //require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/list.php';
                        
                    break;
                case 'editBanTin':
                    $result=$this->editNewsletter();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/editBanTin.php';
                    break;
                case 'xoaBanTin':
                    $this->deleteNewsletter();
                    
                    break;
                case 'contact':
                    $tams = $this->getNameGroup();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/contact.php';
                    break;
    
                case 'list':
                    $results = $this->getlistCustomer();
                    $tams = $this->getNameGroup();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/list.php';
                    
                    break;
                case 'detail':
                    $tams = $this->getNameGroup();
                    $temp = $this->getDetailedNewsletter();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/detail.php';
                    // require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/list.php';
                    // require_once 'views/client/page/detail.php';
                    break;  

                case 'introduce':
                   //require_once 'views/client/page/introduce.php';
                    break;
                
                case 'newspage':
                    $tams = $this->getNameGroup();
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/newspage.php';
                    break;
                default:   
                    $tams = $this->getNameGroup();
                    $list = $this->getNewsletterList();
                    $list2 = $this->getListIMGCategory();
                    
                    require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/page/home.php';
                    break;
            }
        }

     
        public function getlistCustomer(){
            $datas= $this->db->getList();
            
            return $datas;
        }

        public function addCustomer(){
            if(isset($_POST['btnThem'])){
                $this->db->add($_POST);

                header('Location: ?action=list');
            }
        }

        public function editCustomer(){
            if(isset($_GET['id'])){
                $data = $this->db->getCustomer($_GET['id']);

                if(isset($_POST['btnSua'])){
                    $id=$_GET['id'];
                    $this->db->edit($_POST);
                    header('Location: ?action=list');
                    //header('Location: views/admin/page/home.php');
                }
            }

            return $data;
        }

        public function deleteCustomer(){
            if(isset($_GET['id'])){
                $this->db->delete($_GET['id']);

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

        // tên của nhóm tin
        public function getNameGroup(){
            $datas= $this->dbCate->getList();
            
            return $datas;
        }

         // danh sách tin tức
        public function getNewsletterList(){
            $datas= $this->dbPro->getList();
            
            return $datas;
        }

        // danh sách tin tức theo id
        public function getListIMGCategory(){
            $datas= $this->dbPro->getListById(3);
            
            return $datas;
        }

        // tin tức chi tiết theo từng id
        public function getDetailedNewsletter(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $datas= $this->dbPro->getCustomer($id);
            }
            return $datas;
        }

        //Sửa bản tin
        public function editNewsletter(){
            $data = $this->getDetailedNewsletter();
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                if(isset($_POST['btnSuaBanGhi'])){
                 
                    $this->dbPro->edit($_POST);
                    header('Location: ?action=home');
                }
            }
           

            return $data;
        }

        //xóa bản tin
        public function deleteNewsletter(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $this->dbPro->delete($id);

                // print_r($id);
                // exit;
                header('Location: ?action=home');
            }
        }
    }
?>