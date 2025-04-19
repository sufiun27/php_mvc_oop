<?php
use core\Controller as Controller;


class HomeController extends Controller{
    use Database;
    use Model;
    
    public function index(){
        //echo "-this is Home controller index method-<br>";
        try{
            $query='select * from user where name=:name';
            $data = $this->query($query, ['name'=>'sufiun']);
            
            //$this->previewData($data);
            //echo $data[0]->name;
           // echo $data[0]['name'];
           // return $result?:[];

           $this->view('home', $data[0]);
           
        }catch(Exception $e){
            echo $e->getMessage();
        }
        echo "this is index from HomeController";

        
    }
    
}