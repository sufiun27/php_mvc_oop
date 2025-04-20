<?php
use Core\Controller;


class Authentication extends Controller {
    use Database;


    public function index(){
        $this->view('signup');
    }
    public function signup(){
        echo "this is signup method from Authentication controller<br>";
        print_r($_POST);
        //showAll();

        if($_SERVER['REQUEST_METHOD']== "POST"){
            $user = new User;
            if($user->validate($_POST)){
               
                $user->insert($_POST);
               
                header("Location: http://localhost/php_mvc_oop/v2/public/signup");
               
            }
            $data['errors'] = $user->errors;	
        }

        $this->view('signup',$data);
}
}