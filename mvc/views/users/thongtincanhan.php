<!DOCTYPE html>
<html>
<head>
	<title>Thông tin cá nhân</title>
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
	<?php include("header.php")?>

	<section class="login-dangnhap" id="main">
		<div class="row-login-dangnhap">
			<div class="logo-login-dangnhap">
				<img src="./public/upload/logo/logo1.png" alt="logo">
			</div>
			<div class="form-login-dangnhap">
				<div class="form">
					<form method="post" id="formThongTinCaNhan" enctype="multipart/form-data" onsubmit="return validateForm(formThongTinCaNhan)">
						<div class="avatar">
							<div class="anhdaidien-canhan">
								<img src="<?php 
								if($_SESSION['infouser']['image'] != "") echo $_SESSION['infouser']['image'];
								else echo './public/upload/taikhoan/anhdaidien.png';?>" id="anhdaidien-avatar">
								<input type="file" name="image_user" id="anhdaidien-canhan" onchange="onChange()">
								<label for="anhdaidien-canhan">Nhấp chọn ảnh</label>
							</div>
						</div>
						<div class="container-dangnhap">
							<div class="email">
								<label for="email"><b>Email</b></label>
								<div class="info-form">
									<i class="fas fa-envelope"></i>
									<input type="email" name="email" value="<?=$_SESSION['infouser']['email']?>" disabled="disabled">
								</div>
							</div>

							<div class="hoten">
								<label for="hoten"><b>Họ tên</b></label>
								<div class="info-form">
									<i class="fas fa-user"></i>
									<input type="text" placeholder="Nhập họ tên" name="username" value="<?=$_SESSION['infouser']['username']?>" id="hoten">
								</div>
							</div>

							<div class="sodienthoai">
								<label for="sdt"><b>Số điện thoại</b></label>
								<div class="info-form">
									<i class="fas fa-phone-alt"></i>
									<input type="text" placeholder="Nhập số điện thoại" name="phone" value="<?=$_SESSION['infouser']['phone']?>" id="SDT" maxlength="10">
								</div>
							</div>

							<div class="diachi">
								<label for="diachi"><b>Địa chỉ</b></label>
								<div class="info-form">
									<i class="fas fa-map-marker-alt"></i>
									<input type="text" placeholder="Nhập địa chỉ" name="address" value="<?=$_SESSION['infouser']['address']?>" id="diaChi">
								</div>
							</div>

							<div class="gioitinh">
								<label for="gioitinh"><b>Giới tính</b></label>
								<div class="chongioitinh">
									<input type="radio" name="gender" value="Nam" <?php if($_SESSION['infouser']['gender'] == "Nam") echo "checked = 'checked'"?>>
									<label for="male">Nam</label>
									<input type="radio" name="gender" value="Nữ" <?php if($_SESSION['infouser']['gender'] == "Nữ") echo "checked = 'checked'"?>>
									<label for="female">Nữ</label>
									<input type="radio" name="gender" value="Khác" <?php if($_SESSION['infouser']['gender'] == "Khác") echo "checked = 'checked'"?>>
									<label for="other">Khác</label>
								</div>
							</div>

							<div class="ngaysinh">
								<label for="ngaysinh"><b>Ngày sinh</b></label>
								<div class="info-form">
									<input type="date" name="birthday" id="ngaysinh" value="<?php if($_SESSION['infouser']['birthday'] != '') echo $_SESSION['infouser']['birthday']?>">
								</div>
							</div>
							<div id="showthongbao"><?=$data['noti']?></div>
							<div class="Login">
								<button type="submit" name="update_info">Cập nhật</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include("footer.php")?>

</body>
<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
<script src="./public/js/scripts.js"></script>
<script src="./public/js/showFormGopy.js"></script>
<!-- <script src="./public/js/validate-form.js"></script> -->
<script type="text/javascript">
	document.getElementById('email').setAttribute('disabled','disabled');
	// document.getElementById('formThongTinCaNhan').onsubmit = function(){
	// 	return validateForm(formThongTinCaNhan);
	// }

	// upload image
	function onChange(){
	// get thông tin của ảnh ở vị trí 0
	var a = document.getElementById('anhdaidien-canhan').files[0];
	// console.log(a);
	// dùng reader để đọc thông tin của file upload đó , ở đây là image
	var reader = new FileReader();
	// đã đọc xong
	reader.onloadend = function(){
		var src = document.getElementById('anhdaidien-avatar');        
		src.src = reader.result;
	}

 	// nếu a tồn tại or đúng thì sẽ thực hiện đổ dữ liệu vào , ở đây là background img
 	if(a){
 		reader.readAsDataURL(a);
 	}else{
 	}
 }
</script>
</html>