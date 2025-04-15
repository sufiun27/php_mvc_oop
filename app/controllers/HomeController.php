<?php
require ROOT .'../core/Controller.php';
use core\Controller as Controller;


class HomeController extends Controller{
    
    public function index(){
        echo "this is index from HomeController";
    }
    
}