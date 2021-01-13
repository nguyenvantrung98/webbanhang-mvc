<?php $rs = mysqli_fetch_assoc($data['thongtincanhan']);?>
<!DOCTYPE html>
<html>
<head>
	<title>Thông tin cá nhân</title>
	
	<?php include('admin-header.php');?>

	<section class="main-admin">
		<?php include('admin-menu.php');?>

		<div class="form-login-dangnhap" style="background: white !important">
			<div class="form">
				<br>
				<h1>Thông tin cá nhân / <span>Chỉnh sửa</span></h1>
				<hr>
				<br>
				<form style="background: white !important" method="post" enctype="multipart/form-data" id="formThongTinCaNhan" onsubmit="return validateForm(formThongTinCaNhan)">
					<div class="avatar">
						<div class="anhdaidien-canhan">
							<input accept="image/*" type="file" name="file-main" id="anhdaidien-canhan" onchange="onChange()" />
							<img src="<?php echo $rs['AnhDaiDien']?>" id="anhdaidien-avatar">
							<!-- <input accept="image/*" type="file" name="file" id="anhdaidien-canhan" onchange="onChange()"> -->
							<label for="anhdaidien-canhan">Nhấp chọn ảnh</label>
						</div>
					</div>
					<div class="container-dangnhap">
						<div class="email">
							<label for="email"><b>Tên đăng nhập</b></label>
							<div class="info-form">
								<input type="text" placeholder="Nhập email" name="email" value="nguyenvantrung07tbh@gmail.com" disabled="disabled">
							</div>
						</div>

						<div class="hoten">
							<label for="hoten"><b>Họ tên</b></label>
							<div class="info-form">
								<input type="text" placeholder="Nhập họ tên" name="hoTen" id="hoten" value="<?php echo $rs['HoTen']?>">
							</div>
						</div>

						<div class="sodienthoai">
							<label for="sdt"><b>Số điện thoại</b></label>
							<div class="info-form">
								<input type="text" placeholder="Nhập số điện thoại" name="sdt" id="SDT" value="<?php echo $rs['SoDienThoai']?>">
							</div>
						</div>

						<div class="diachi">
							<label for="diachi"><b>Địa chỉ</b></label>
							<div class="info-form">
								<input type="text" placeholder="Nhập địa chỉ" name="diaChi" id="diaChi" value="<?php echo $rs['DiaChi']?>">
							</div>
						</div>

						<div class="diachi">
							<label for="diachi"><b>Vai trò</b></label>
							<div class="info-form">
								<input type="text" name="vaiTro" id="vaiTro" disabled="disabled" value="<?php echo $rs['VaiTro'];?>">
							</div>
						</div>

						<div class="gioitinh">
							<label for="gioitinh"><b>Giới tính</b></label>
							<div class="chongioitinh">
								<input type="radio" name="gender" value="Nam" <?php if($rs['GioiTinh'] == 'Nam'){
									echo "checked = 'checked'";
								}?>>
								<label for="male">Nam</label>
								<input type="radio" name="gender" value="Nữ" <?php if($rs['GioiTinh'] == 'Nữ'){
									echo "checked = 'checked'";
								}?>>
								<label for="female">Nữ</label>
								<input type="radio" name="gender" value="Khác" <?php if($rs['GioiTinh'] == 'Khác'){
									echo "checked = 'checked'";
								}?>>
								<label for="other">Khác</label>
							</div>
						</div>

						<div class="ngaysinh">
							<label for="ngaysinh"><b>Ngày sinh</b></label>
							<div class="info-form">
								<input type="date" name="ngaysinh" id="ngaysinh" value="<?php echo $rs['NgaySinh']?>">
							</div>
						</div>

						<div style="margin-top: 10px;" class="showdmk">
							<input type="checkbox" name="dmk" id="dmk" onclick="checkbox()"><b>Đổi mật khẩu</b>
						</div>
						<div class="doimatkhau" id="doimatkhau">
							<label for="mkcu"><b>Mật khẩu hiện tại</b></label>
							<div class="info-form">
								<input type="" placeholder="Nhập mật khẩu hiện tại" name="mkhientai" id="mkhientai" disabled="disabled">
							</div>
							<label for="mkmoi"><b>Mật khẩu mới</b></label>
							<div class="info-form">
								<input type="" placeholder="Nhập mật khẩu mới" name="mkmoi" id="mkmoi" disabled="disabled">
							</div>
							<label for="mkmoiag"><b>Nhập lại mật khẩu mới</b></label>
							<div class="info-form">
								<input type="" placeholder="Nhập lại mật khẩu mới" name="nlmkmoi" id="nlmkmoi" disabled="disabled">
							</div>
						</div>
						<br>
						<div id="showthongbao"><?php echo $data['tbao']?></div>
						<br>
						<div class="thongtincn">
							<button type="submit" name="updatesanpham">Cập nhật</button>
							<button type="reset" onclick="removeAnh()">Làm mới</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	<?php include('admin-footer.php');?>
	
</body>
<script src="./public/js/validate-form.js"></script>
<script src="./public/js/toggleMenu.js"></script>
<script type="text/javascript">
	document.getElementById('doimatkhau').style.display = 'none';
	function checkbox(){
		var a = document.getElementById('dmk');
		if(a.checked == true){
			document.getElementById('doimatkhau').style.display = 'block';
			document.getElementById('mkhientai').removeAttribute('disabled');
			document.getElementById('mkmoi').removeAttribute('disabled');
			document.getElementById('nlmkmoi').removeAttribute('disabled');
		}
		else{
			document.getElementById('doimatkhau').style.display = 'none';
			document.getElementById('mkhientai').setAttribute('disabled','disabled');
			document.getElementById('mkmoi').setAttribute('disabled','disabled');
			document.getElementById('nlmkmoi').setAttribute('disabled','disabled');
		}
	}

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
<script type="text/javascript">
	var hinh = document.getElementById('anhdaidien-avatar').src;
	// console.log(hinh);
	function removeAnh(){
		document.getElementById('anhdaidien-avatar').src = hinh;

		document.getElementById('doimatkhau').style.display = 'none';
		document.getElementById('mkhientai').setAttribute('disabled','disabled');
		document.getElementById('mkmoi').setAttribute('disabled','disabled');
		document.getElementById('nlmkmoi').setAttribute('disabled','disabled');
	}
</script>
</html>