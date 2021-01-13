<?php 
require_once "./mvc/core/App.php";
require_once "./mvc/core/Controller.php";
require_once "./mvc/core/DataBase.php";

// dựa vào vai trò phân quyền truy cập trên url
if(isset($_GET["url"])){
	// tách chuỗi thành mảng và cắt bằng 1 chuỗi nào đó
	$arr =  explode("/", filter_var(trim($_GET["url"], "/")));
	if(substr($arr[0],0,5) == "Admin"){
		if(isset($_SESSION['infouser']) && ($_SESSION['infouser']['role'] == "Quản trị" || $_SESSION['infouser']['role'] == "Admin")){
			
		}else{
			header("location: http://localhost/webbanhang-mvc/TaiKhoanController/login");
			exit();
		}
	}
}
?>