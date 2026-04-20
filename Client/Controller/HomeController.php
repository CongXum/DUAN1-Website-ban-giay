<?php

class HomeController {

    public function index(){
    
        global $conn;

        $product = new Product($conn);

        var_dump($product);
        require_once 'Client/View/Pages/Home.php';
    
    }

}