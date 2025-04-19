<?php
use core\Controller as Controller;


class HomeController extends Controller{
    use Database;
    use Model;
    
    public function index($data){
        print_r($data);
        echo "-this is Home controller index method-<br>";
        try{
            $query='select * from user where id=:id';
            $data = $this->query($query, ['id'=>$data['id']]);
            
            //$this->previewData($data);
            //echo $data[0]->name;
           // echo $data[0]['name'];
           // return $result?:[];

           $this->view('home', $data[0]);
           
        }catch(Exception $e){
            echo $e->getMessage();
        }
        // echo "this is index from HomeController";
         

        
    }
    
}