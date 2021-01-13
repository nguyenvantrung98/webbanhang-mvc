<!DOCTYPE html>
<html>
<head>
	<title>Quên mật khẩu</title>
	<meta charset="UTF-8">
	<meta name="mota" content="Danh sách sản phẩm">
	<base href="http://localhost/webbanhang-mvc/HomeController">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<link rel="stylesheet" href="./public/vendors/css/grid.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="./public/img/footer/logo1.png"/>
	<meta name="tukhoa" content="Quan-ao,Giay-dep,Phu-kien">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="tacgia" content="Nguyễn Văn Trung">
</head>
<body>
	<?php include("./mvc/views/users/header.php")?>

	<section class="login-dangnhap" id="main">
		<div class="row-login-dangnhap">
			<div class="logo-login-dangnhap">
				<img src="./public/upload/logo/logo1.png" alt="logo">
			</div>
			<div class="form-login-dangnhap">
				<div class="form">
					<div class="avatar">
						<img src="./public/img/footer/logo1.png" alt="logo">
					</div>
					<form action="" method="post" onsubmit="return validateForm(formMaXacNhan)" id="formMaXacNhan">
						<div class="container-dangnhap">
							<div><i style="color: red">Mã xác nhận đã được gửi vào email của bạn</i></div>
							<div class="tendangnhap">
								<label for="quenmatkhau1"><b>Mã xác nhận</b></label>
								<div class="info-form">
									<i class="fas fa-user-check"></i>
									<input type="number" min="0" maxlength="6" placeholder="Nhập mã xác nhận (ví dụ : 098765)" name="verification" id="quenmatkhau1">
								</div>
							</div>
							<div id="showthongbao"><?=$data['noti']?></div>
							<i style="color: rgba(0,0,0,0.6);">Note*: Vui lòng không chuyển trang trong thời gian đợi nhập mã !</i>	
							<div class="Login">
								<button type="submit" name="next_forgot_pass_confirm">Tiếp tục</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include("./mvc/views/users/footer.php")?>
	
</body>
<!-- <script src="./public/js/validate-form.js"></script> -->
<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
<script src="./public/js/scripts.js"></script>
<script src="./public/js/showFormGopy.js"></script>
</html>