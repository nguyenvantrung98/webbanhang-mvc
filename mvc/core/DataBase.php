<?php 
    class DataBase{
        public $conn;
        protected $servername = 'localhost';
        protected $username = 'root';
        protected $password = '';
        protected $dbname = 'webbanhang';

        function __construct(){
            $this->conn = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
            if(!$this->conn){
                echo "Kết nối thất bại";
                exit();
            }

            // tắt autocommit
            // mysqli_commit($this->conn,FALSE);
        }
    }
?>