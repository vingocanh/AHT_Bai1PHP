<?php
// session_start();

    include_once 'models/UserModel.php';
    include_once 'models/AminModel.php';
    include_once 'models/CategoryModel.php';
    include_once 'models/ProductModel.php';
    include_once 'config/config.php';
    require_once 'config/session.php';
    
    class HomeController{

        private $dbUser;
        private $dbCustomer;
        private $dbCate;
        private $dbPro;
        public function __construct(){
            $this->dbUser=new UserDatabase();
            $this->dbCustomer=new CustomerDatabase();
            $this->dbCate= new CategoryDatabase();
            $this->dbPro= new ProducDatabase();
        }
        public function Home(){
            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }else{
                $action = '';
            }
            switch($action){
                case 'login':
                    SessionUser::huySession("sessionUsers");
                    if(SessionUser::getSession("sessionUsers") != false){
                        if(SessionUser::getSession("sessionUsers")['level'] == 0){
                            echo "<script>alert('Welcome admin D')</script>";
                            require_once 'views/client/page/home.php';
                        }else{
                            echo "<script>alert('Welcome user')</script>";
                            require_once ('views/client/index.php');
                        }
                    }else{
                        $error = $this->login();
                        require_once ('views/client/login.php');
                    }
                    break;
                
                case 'signup':
                    $error = $this->signUp();
                    include_once 'views/client/signup.php';
                    
                    break;

                case 'contact':
                    $tam = $this->getNameGroup();
                    require_once 'views/client/page/contact.php';
                    break;

                case 'home':
                    $tam = $this->getNameGroup();
                    $list = $this->getNewsletterList();
                    $list2 = $this->getListIMGCategory();
                    require_once 'views/client/page/home.php';
                    break;
                    
                case 'introduce':
                    $tam = $this->getNameGroup();
                    require_once 'views/client/page/introduce.php';
                    break;
                case 'X?? H???I':
                    $tam = $this->getNameGroup();
                    $list = $this->getListByGroupName();
                    $list2 = $this->getListByGroupName();
                    require_once 'views/client/page/society.php';
                    break;

                case '????? ??I???N T???':
                    $tam = $this->getNameGroup();
                    $list = $this->getListByGroupName();
                    $list2 = $this->getListByGroupName();
                    require_once 'views/client/page/electronic.php';
                    break;
                case 'TH???I TRANG': 
                    $tam = $this->getNameGroup();
                    $list = $this->getListByGroupName();
                    $list2 = $this->getListByGroupName();
                    require_once 'views/client/page/fashion.php';
                    break;
                case 'out':
                    $this->logOut();
                    header('Location: /php/AHT/Bai1/index.php?action=login');
                    break;
                
                case 'detail':
                    $tam = $this->getNameGroup();
                    $temp = $this->getDetailedNewsletter();
                    require_once 'views/client/page/detail.php';
                    break;
                default: 
                    $tam = $this->getNameGroup();
                    $list = $this->getNewsletterList();
                    $list2 = $this->getListIMGCategory();
                    require_once 'views/client/page/home.php';
                    break;
            }
        }

        public function login(){
            $email = $password = $fullName = NULL;
            $error = array();
            $error['adminEmail'] = $error['adminPassWord'] = NULL;
            if (!empty($_POST)) {

                if(isset($_POST['adminEmail'])){
                    $email = $_POST['adminEmail'];
                }else{
                   $error['adminEmail'] = 'C???n ??i???n email';
                }

                if(isset($_POST['adminPassWord'])){
                    $password = md5($_POST['adminPassWord']);
                }else{
                    $error['adminPassWord'] = 'C???n ??i???n m???t kh???u'; 
                }
    
                if ($email != "" && $password != "") {
                    $result = $this->dbUser->getListById($_POST);
                    // var_dump($result);
                    // exit;
                    $check = $result->num_rows;
                    if ($check > 0) {
                        $data = $result->fetch_array(); 
                        SessionUser::setSession("sessionUsers", $data);
                        if ($data['level'] == 0) { 
                            echo '<script>alert("Welcome admin C")</script>';
                           header('Location: views/admin/index.php');     
                        } else {
                            echo '<script>alert("Welcome user")</script>';
                            header('Location: ?action=home');
                        }
                    } else {
                        echo "<script>alert('Sai m???t kh???u ho???c t??n ????ng nh???p')</script>";
                    }
                }
            }
            return $error;
        }

        public function signUp() {
            $name = $password = $email = $level = NULL;
            $error = array();
            $error['name'] = $error['email'] = $error['passWord'] = $error['level'] = NULL;
    
            if (isset($_POST['btn_register'])) {
                if (empty($_POST['name'])) {
                    $error['name'] = '* C???n ??i???n h??? t??n';
                } else {
                    $name = $_POST['name'];
                }
                if (empty($_POST['passWord'])) {
                    $error['passWord'] = '* C???n ??i???n m???t kh???u';
                } else {
                    $password = md5($_POST['passWord']);
                }
                if (empty($_POST['email'])) {
                    $error['email'] = '* C???n ??i???n email';
                } else {
                    $email = $_POST['email'];
                }
                if (empty($_POST['level'])) {
                    $error['level'] = '* C???n ??i???n tr???ng th??i';
                } else {
                    $level = $_POST['level'];
                }
    
               
                if ($name != "" && $password !="" && $email!="" && $level!="") {
                    //check email
                    $check = $this->dbUser->getCustomer($email);
                    // var_dump($check);
                    // exit;
                    if (($check->num_rows) > 0) {
                        $error['email'] = '* Email ???? b??? tr??ng';
                        echo "<script>alert('Email ???? b??? tr??ng')</script>";
                    } else {
                        $this->dbUser->add($_POST);
                        echo "<script>alert('????ng k?? th??nh c??ng')</script>";
                        header('Location: ?action=login');
                      
                
                    }
                }
            }
            return $error;
        }

        public function logOut(){
            if (isset($_GET['out'])) {
                // echo 'H???y Session';
                // exit;
                $tam = "sessionUsers";
                SessionUser::huySession($tam);
                
                // header('Location: ?action=login');
               
            }
        }

         // t??n  nh??m tin
         public function getNameGroup(){
            $datas= $this->dbCate->getList();           
            return $datas;
        }

         //danh s??ch tin t???c
         public function getNewsletterList(){
            $datas= $this->dbPro->getList();
            
            return $datas;
        }

         // danh s??ch tin t???c theo id
         public function getListIMGCategory(){
            $datas= $this->dbPro->getListById(3);
            
            return $datas;
        }

        
        // tin t???c chi ti???t theo t???ng id
        public function getDetailedNewsletter(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $datas= $this->dbPro->getCustomer($id);
            }
            return $datas;
        }

        // danh s??ch b???n tin theo t???ng nh??m tin
        public function getListByGroupName(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $datas= $this->dbPro->getListById($id);
            }
                  
            return $datas;
        }
  
    }
?>