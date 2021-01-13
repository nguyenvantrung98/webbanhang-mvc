<!DOCTYPE html>
<html>
<head>
	<title>Đổi mật khẩu</title>
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
						<div title="Ảnh đại diện" class="anhdaidien-canhan">
							<img src="<?=$_SESSION['infouser']['image']?>">
						</div>
					</div>
					<form method="post" id="formDoiMatKhau">
						<div class="container-dangnhap">
							<div class="matkhaucu">
								<label for="matkhaucu"><b>Mật khẩu hiện tại</b></label>
								<div class="info-form">
									<i class="fas fa-key"></i>
									<input type="password" placeholder="Nhập mật khẩu hiện tại" name="password" id="mkhientai">
								</div>
							</div>

							<div class="matkhaumoi">
								<label for="matkhaumoi"><b>Mật khẩu mới</b></label>
								<div class="info-form">
									<i class="fas fa-key"></i>
									<input type="password" placeholder="Nhập mật khẩu mới" name="new_password" id="mkmoi">
								</div>
							</div>

							<div class="nlmatkhaumoi">
								<label for="nlmatkhaumoi"><b>Nhập lại mật khẩu mới</b></label>
								<div class="info-form">
									<i class="fas fa-key"></i>
									<input type="password" placeholder="Nhập lại mật khẩu mới" name="again_password" id="nlmkmoi">
								</div>
							</div><br>
							<div id="showthongbao"><?=$data['noti']?></div>
							<div class="Login">
								<button type="submit" name="change_pass">Đổi mật khẩu</button>
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
<script type="text/javascript">
	document.getElementById('formDoiMatKhau').onsubmit = function(){
		return validateForm(formDoiMatKhau);
	}
</script>
</html>