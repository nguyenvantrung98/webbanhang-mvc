<?php 
class App{
        // khai bào mặc định khi mà ng dùng ko gõ gì lên url
        protected $controller = "HomeController"; // mặc định khi ng dùng ko nhập
        protected $action = "home";
        protected $params = [];

        function __construct(){

            $arr = $this->UrlProcess();

            // Controller
            if(file_exists("./mvc/controller/".$arr[0].".php") ){
                $this->controller = $arr[0];
                unset($arr[0]);
            }
            // // var_dump($arr);
            require_once "./mvc/controller/". $this->controller .".php";
            $this->controller = new $this->controller;

            // Action
            if(isset($arr[1])){
                if(method_exists($this->controller , $arr[1]) ){
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }

            // Params
            $this->params = $arr?array_values($arr):[];

            call_user_func_array([$this->controller, $this->action], $this->params );
        }

        // tách chuỗi url
        function UrlProcess(){
            if( isset($_GET["url"]) ){
                // tách chuỗi thành mảng và cắt bằng 1 chuỗi nào đó
                return explode("/", filter_var(trim($_GET["url"], "/")));
            }
        }
    }
    ?>