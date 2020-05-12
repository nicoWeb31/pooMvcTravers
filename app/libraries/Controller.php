<?php 

/**
 * base controller 
 * Load the model and view
 */

class Controller 
{

    //load model
    public function model($model){
        //require model file
        require_once '../app/models/' .$model . '.php'; 

        //instanciate new model
        return new $model();
    }

    //Load Views 
    public function view($view, $data = []){

        //check the view file
        if(file_exists('../app/views/' . $view .'.php')){
            require_once '../app/views/' . $view .'.php';
        }else{
            //view does not exist
            var_dump($view);
            echo '../app/views/' . $view .'.php';
            die('view does not exist');
        }


    }


}