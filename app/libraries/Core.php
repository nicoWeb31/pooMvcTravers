<?php 
error_reporting(E_ALL & ~E_NOTICE);

//app core classe 
//creates URL & loads core controller
//URL FORMAT - /controller/method/params


class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params =[];


    public function __construct()
    {
        // var_dump($this->getUrl());
        $url = $this->getUrl();

        //look in controllrt for first value
        if($url && file_exists('../app/controller/'. ucwords( $url[0]) .'.php')){
            //if exist,set as controller
            $this->currentController = ucwords($url[0]);
            //unset 0 index 
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controller/'.$this->currentController .'.php';

        //instantiate
        $this->currentController = new $this->currentController;



        //check for second part url
        if(isset($url[1])){
            //check to si the lmethode exist in conntroller
            if(method_exists($this->currentController,$url[1])){

                $this->currentMethod = $url[1];
            }
            // echo $this->currentMethod;
            unset($url[1]);
        }


        //get params 
        $this->params = $url ? array_values($url) : [];


        //call a calback with array of params
        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
        

    }

    public function getUrl(){

        if(isset($_GET['url'])){

            //rtrim : rtrim — Supprime les espaces (ou d'autres caractères) de fin de chaîne
            $url = rtrim($_GET['url']);
            //filter_var : rtrim — Supprime les espaces (ou d'autres caractères) de fin de chaîne
            $url = filter_var($url,FILTER_SANITIZE_URL);

            //return un array
            $url = explode('/',$url);
            return $url;



        }

    }
}