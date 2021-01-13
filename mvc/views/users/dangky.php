<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký</title>
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
	
	<section class="register-dangky" id="main">
		<div class="row-register-dangky">
			<div class="logo-register-dangky">
				<img src="./public/upload/logo/logo1.png" alt="logo">
			</div>
			<div class="form-register-dangky">
				<form action="" method="post" id="formDangKy">
					<div class="avatar">
						<img src="./public/img/footer/logo1.png" alt="logo">
						<!-- <h1>Thong tin ca nhan</h1> -->
					</div>

					<div class="container-dangky">
						<div class="tendangnhap">
							<label for="email"><b>Tên đăng nhập</b></label>
							<div class="info-form">
								<i class="fas fa-envelope"></i>
								<input type="email" placeholder="Nhập email" name="email" id="tenDangNhap" >
							</div>
						</div>
						
						<div class="hoten">
							<label for="hoTen"><b>Họ tên</b></label>
							<div class="info-form">
								<i class="fas fa-user"></i>
								<input type="text" placeholder="Nhập họ tên" name="username" id="hoTen" autocomplete="off">
							</div>
						</div>
						
						<div class="matkhau">
							<label for="matkhau"><b>Mật khẩu</b></label>
							<div class="info-form">
								<i class="fas fa-key"></i>
								<input type="password" placeholder="Nhập mật khẩu" name="password" id="matKhau" autocomplete="off" >
							</div>
						</div>

						<div class="nhaplaimatkhau">
							<label for="nhaplaimatkhau"><b>Nhập lại mật khẩu</b></label>
							<div class="info-form">
								<i class="fas fa-key"></i>
								<input type="password" placeholder="Nhập lại mật khẩu" name="password_again" id="nhapLaiMatKhau" autocomplete="off" >
							</div>
						</div>
						<div id="showthongbao"><?=$data['noti']?></div>
						<div class="Register">
							<button type="submit" name="register_submit">Đăng ký</button>
						</div>
					</div>

					<div class="dangky-forgot1">
						<a class="dangky" href="./TaiKhoanController/login">Đăng nhập</a>
						<a class="forgot" href="./TaiKhoanController/forgot_pass">Quên mật khẩu ?</a>
					</div>
				</form>
			</div>
		</div>
	</section>

	<?php require_once "./mvc/views/users/footer.php";?>
	
	
</body>
<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
<script src="./public/js/scripts.js"></script>
<script src="./public/js/showFormGopy.js"></script>
<script type="text/javascript">
	document.getElementById('formDangKy').onsubmit = function(){
		return validateForm(formDangKy);
	};
</script>
<!-- <script src="./public/js/validate-form.js"></script> -->
</html>