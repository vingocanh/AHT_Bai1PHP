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
                case 'XÃ HỘI':
                    $tam = $this->getNameGroup();
                    $list = $this->getListByGroupName();
                    $list2 = $this->getListByGroupName();
                    require_once 'views/client/page/society.php';
                    break;

                case 'ĐỒ ĐIỆN TỬ':
                    $tam = $this->getNameGroup();
                    $list = $this->getListByGroupName();
                    $list2 = $this->getListByGroupName();
                    require_once 'views/client/page/electronic.php';
                    break;
                case 'THỜI TRANG': 
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
                   $error['adminEmail'] = 'Cần điền email';
                }

                if(isset($_POST['adminPassWord'])){
                    $password = md5($_POST['adminPassWord']);
                }else{
                    $error['adminPassWord'] = 'Cần điền mật khẩu'; 
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
                        echo "<script>alert('Sai mật khẩu hoặc tên đăng nhập')</script>";
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
                    $error['name'] = '* Cần điền họ tên';
                } else {
                    $name = $_POST['name'];
                }
                if (empty($_POST['passWord'])) {
                    $error['passWord'] = '* Cần điền mật khẩu';
                } else {
                    $password = md5($_POST['passWord']);
                }
                if (empty($_POST['email'])) {
                    $error['email'] = '* Cần điền email';
                } else {
                    $email = $_POST['email'];
                }
                if (empty($_POST['level'])) {
                    $error['level'] = '* Cần điền trạng thái';
                } else {
                    $level = $_POST['level'];
                }
    
               
                if ($name != "" && $password !="" && $email!="" && $level!="") {
                    //check email
                    $check = $this->dbUser->getCustomer($email);
                    // var_dump($check);
                    // exit;
                    if (($check->num_rows) > 0) {
                        $error['email'] = '* Email đã bị trùng';
                        echo "<script>alert('Email đã bị trùng')</script>";
                    } else {
                        $this->dbUser->add($_POST);
                        echo "<script>alert('Đăng ký thành công')</script>";
                        header('Location: ?action=login');
                      
                
                    }
                }
            }
            return $error;
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

         // tên  nhóm tin
         public function getNameGroup(){
            $datas= $this->dbCate->getList();           
            return $datas;
        }

         //danh sách tin tức
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

        // danh sách bản tin theo từng nhóm tin
        public function getListByGroupName(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $datas= $this->dbPro->getListById($id);
            }
                  
            return $datas;
        }
  
    }
?>