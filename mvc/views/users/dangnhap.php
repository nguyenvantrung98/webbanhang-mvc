<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
	<meta charset="UTF-8">
	<meta name="mota" content="Danh sách sản phẩm">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<base href="http://localhost/webbanhang-mvc/HomeController">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<link rel="stylesheet" href="./public/vendors/css/grid.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="./public/img/footer/logo1.png"/>
	<meta name="tukhoa" content="Quan-ao,Giay-dep,Phu-kien">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="tacgia" content="Nguyễn Văn Trung">
</head>
<body>
	<?php require_once "./mvc/views/users/header.php";?>
	
	<section class="login-dangnhap" id="main">
		<div class="row-login-dangnhap">
			<div class="logo-login-dangnhap">
				<img src="./public/upload/logo/logo1.png" alt="logo">
			</div>
			<div class="form-login-dangnhap">
				<div class="form">
					<div class="avatar">
						<img src="./public/upload/logo/logo1.png" alt="logo">
						<!-- <h1>Dang nhap</h1> -->
					</div>
					
					<div class="container-dangnhap">
						<form action="" style="margin-bottom: 0px !important" method="post" id="formDangNhap">
							<div class="tendangnhap">
								<label for="uname"><b>Tên đăng nhập</b></label>
								<div class="info-form">
									<i class="fas fa-envelope"></i>
									<input type="email" placeholder="Nhập email" name="username" id="tenDangNhap" autocomplete="on">
								</div>
							</div>

							<div class="matkhau">
								<label for="psw"><b>Mật khẩu</b></label>
								<div class="info-form">
									<i class="fas fa-key"></i>
									<input type="password" placeholder="Nhập mật khẩu" name="password" id="matKhau">
								</div>
							</div>

							<div class="remember">
								<input type="checkbox" checked="checked" name="remember"> Remember me
							</div>
							<div id="showthongbao"><?=$data['noti'];?></div>
							<div class="Login">
								<button id="login" type="submit" name="login">Đăng nhập</button>
								<hr>
								<p style="text-align: center;font-weight: 100">------ OR ------
								</p>
							</div>
						</form>
						<div class="social-login">
							<button class="fb">Đăng nhập bằng facebook</button>
							<button class="twitter">Đăng nhập bằng Twitter</button>
							<button class="google">Đăng nhập bằng Google</button>
						</div>
					</div>

					<div class="dangky-forgot">
						<a class="dangky" href="./TaiKhoanController/register">Đăng ký</a>
						<a class="forgot" href="./TaiKhoanController/forgot_pass">Quên mật khẩu ?</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<?php require_once "./mvc/views/users/footer.php";?>

</body>
<script src="./public/js/showFormGopy.js"></script>
<script type="text/javascript">
	document.getElementById('formDangNhap').onsubmit = function(){
		return validateForm(formDangNhap);
	};
</script>
<script src="./public/js/validate-form.js"></script>
</html>