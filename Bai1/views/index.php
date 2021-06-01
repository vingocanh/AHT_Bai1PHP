<?php
require_once 'controllers/CustomerController.php';
$controller = new CustomerController();
$controller->Customer();

// require_once 'controllers/UserController.php';

// echo $_SESSION['userAdmin']['level'];
// if($_SESSION['userAdmin']['level'] == 0){
//     $controllerCustomer = new CustomerController();
//     $controllerCustomer->Customer();
// }else{
//     $controllerUser = new Controller();
//     $controllerUser->Run();
// }

