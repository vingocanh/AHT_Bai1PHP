<?php
    // include_once 'controllers/AdminController.php';
    // $controller = new Controller();
    // $controller->Run();
    require_once  'controllers/HomeController.php';
    $controller = new HomeController();
    $controller->Home();
?>