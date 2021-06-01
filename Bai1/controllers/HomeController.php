<?php
// session_start();

    include_once 'models/UserModel.php';
    include_once 'models/CustomerModel.php';
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
                    $tam = $this->getName();
                    require_once 'views/client/page/contact.php';
                    break;

                case 'home':
                    $tam = $this->getName();
                    require_once 'views/client/page/home.php';
                    break;
                    
                case 'introduce':
                    $tam = $this->getName();
                    require_once 'views/client/page/introduce.php';
                    break;

                case 'out':
                    $this->logOut();
                    break;

                default: 
                    $tam = $this->getName();
                    $list = $this->getListProduct();
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
                    $result = $this->dbUser->Login($email, $password);
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
                    $check = $this->dbUser->checkExists($email);
                    // var_dump($check);
                    // exit;
                    if ($check->num_rows > 0) {
                        $error['email'] = '* Email đã bị trùng';
                        echo "<script>alert('Email đã bị trùng')</script>";
                    } else {
                        $this->dbUser->singup($name, $email, $password, $level);
                        echo "<script>alert('Đăng ký thành công')</script>";
                        header('Location: ?action=login');
                      
                     exit;
                        
                    }
                }
            }
            var_dump($error);
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

        public function getName(){
            $datas= $this->dbCate->getCategory();
            
            return $datas;
        }

        public function getListProduct(){
            $datas= $this->dbPro->getList();
            
            return $datas;
        }
       
    }
?>