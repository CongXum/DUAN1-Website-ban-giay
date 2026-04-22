<?php

class HomeController {

    public function index(){
    
        global $conn;

        $product = new Product($conn);

        require_once 'Client/View/Pages/Home.php';
    
    }

}