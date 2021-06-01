<?php

    include_once 'models/UserModel.php';
    include_once 'config/config.php';
    session_start();
    class Controller{

        private $db;
        public function __construct(){
            $this->db=new UserDatabase();
        }
        public function Run(){
            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }else{
                $action = '';
            }
            switch($action){
                case 'signup':
                    $error = $this->signUp();
                    if(empty($error)){
                        require_once ('views/admin/login.php');
                    }else{
                        require_once ('views/client/signup.php');
                    }
                    
                    break;

                case 'out':
                    $this->out();
                    require_once ('views/admin/login.php');
                    break;
                    
                default:     
                    // session_destroy();
                    if (!empty($_SESSION['user'])) {
                        require_once ('views/index.php');
                    } else {
                        $error = $this->loginAdmin();
                        // echo "<script>alert('Bạn chưa đăng nhập')</script>";
                        require_once ('views/admin/login.php');
                    }
                    break;
            }
        }

        public function out(){
            if (isset($_GET['out'])) {
                session_destroy();		
            }
        }
        public function loginAdmin(){
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
                    $result = $this->db->Login($email, $password);
                    $check = $result->num_rows;
                    if ($check > 0) {
                        $data = $result->fetch_array(); 
                        $_SESSION['user'] = $data;
                       
                       
                    } else {
                        echo "<script>alert('Sai mật khẩu hoặc tên đăng nhập')</script>";
                    }
                }
            }
            return $error;
        }
        public function signUp() {
            $name = $password = $email = $status = NULL;
            $error = array();
            $error['name'] = $error['email'] = $error['passWord'] = $error['status'] = NULL;
    
            if (isset($_POST['btn_register'])) {
                if (empty($_POST['name'])) {
                    $error['name'] = '* Cần điền họ tên';
                } else {
                    $name = $_POST['name'];
                }
                if (empty($_POST['passWord'])) {
                    $error['passWord'] = '* Cần điền mật khẩu';
                } else {
                    $password = md5(md5($_POST['passWord']));
                }
                if (empty($_POST['email'])) {
                    $error['email'] = '* Cần điền email';
                } else {
                    $email = $_POST['email'];
                }
                if (empty($_POST['status'])) {
                    $error['status'] = '* Cần điền trạng thái';
                } else {
                    $status = $_POST['status'];
                }
    
                if ($name && $password && $email && $status) {
                    $check = $this->db->checkExists($email);
    
                    if ($check->num_rows > 0) {
                        $error['username_exist'] = '* Email đã bị trùng';
                        echo "<script>alert('Email đã bị trùng')</script>";
                    } else {
                        $this->db->singup($name, $email, $password, $status);
                        echo "<script>alert('Đăng ký thành công')</script>";
                        
                    }
                }
                
            }
            return $error;
        }

    }
?>