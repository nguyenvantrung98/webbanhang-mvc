<?php $rs = mysqli_fetch_assoc($data['chitiettaikhoan']);?>
<div id="content-admin">
	<h1>Tài khoản / <span>Khóa tài khoản</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<a href="./AdminTaiKhoanController/themtaikhoan/add"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<div class="content-main">
		<form id="themDanhMuc" action="" method="post" enctype="multipart/form-data">
			<div class="anhdaidien">
				<div>
					<img id="img1" src="<?php echo $rs['AnhDaiDien']?>">
				</div>
			</div>
			<div class="themtaikhoan">
				<label>Họ tên</label>
				<input type="text" value="<?php echo $rs['HoTen']?>" disabled="disabled">
			</div>
			<div class="themtaikhoan">
				<label>Tên đăng nhập</label>
				<input type="email" value="<?php echo $rs['TenDangNhap']?>" disabled="disabled">
			</div>
			<div class="themtaikhoan">
				<label>Số điện thoại</label>
				<input type="text" value="<?php echo $rs['SoDienThoai']?>" disabled="disabled">
			</div>
			<div class="themtaikhoan">
				<label>Vai trò</label>
				<input type="text" value="<?php echo $rs['VaiTro']?>" disabled="disabled">
			</div>
			<div class="themtaikhoan">
				<label>Địa chỉ</label>
				<input type="text" value="<?php echo $rs['DiaChi']?>" disabled="disabled">
			</div>
			<div class="themtaikhoan">
				<label>Giới tính</label>
				<input type="text" value="<?php if($rs['GioiTinh'] != '') echo $rs['GioiTinh'];
				else echo "Trống";?>" disabled="disabled">
			</div>
			<div class="themtaikhoan">
				<label>Ngày sinh</label>
				<input type="text" value="<?php if($rs['NgaySinh'] == '0000-00-00') echo "Trống";
				else echo $rs['NgaySinh']?>" disabled="disabled">
			</div>
			<!-- nếu vai trò của tài khoản đó là quản trị thì ko in ra ngày kích hoạt và trạng thái -->
			<?php if($rs['VaiTro'] != 'Admin'){ 
				if($rs['TrangThai'] != 0) {?>
					<div class="themtaikhoan">
						<label>Ngày kích hoạt</label>
						<input type="text" value="<?php echo $rs['ngay_kichhoat']?>" disabled="disabled">
					</div>
				<?php }?>
				<div class="themtaikhoan">
					<!-- có 4 trang thai: 0:chưa kích hoạt , 1:đã kích hoạt , 2:bị khóa ,3:bị xóa nhưng còn trong database -->
					<label>Trạng thái</label>
					<input type="text" name="diachi" id="diaChi" placeholder="Nhập địa chỉ"
					value="<?php if($rs['TrangThai'] == 0) echo "Chưa kích hoạt";
					else if($rs['TrangThai'] == 1) echo "Đã kích hoạt"; 
					else if($rs['TrangThai'] == 2) echo "Đang khóa";
					else if($rs['TrangThai'] == 3) echo "Đã xóa";
					?>" disabled="disabled">
				</div>
				<?php if($rs['TrangThai'] == 2){ ?>
					<div class="themtaikhoan">
						<label>Ngày khóa</label>
						<input type="text" value="<?php echo $rs['ngay_khoa']?>" disabled="disabled">
					</div>
					<div class="themtaikhoan">
						<label>Ngày mở khóa</label>
						<input type="text" value="<?php echo $rs['ngay_mokhoa']?>" disabled="disabled">
					</div>
				<?php } }?>
				<br>
				<div id="showthongbao"></div>
				<br>
				<!-- lock tài khảon -->
				<?php if($rs['TrangThai'] == 1){ ?>
					<div class="xuly">
						<div id="songaykhoa">
							<label>Chọn số ngày khóa</label>
							<select name="chonsongaykhoa">
								<option value="1">1</option>
								<option value="3">3</option>
								<option value="5">5</option>
								<option value="7">7</option>
								<option value="10">10</option>
							</select>
							<button type="submit" name="locktaikhoan">Khóa tài khoản</button>
						</div>
					</div>
				<?php } ?>
				<!-- unlock tài khoản -->
				<?php if($rs['TrangThai'] == 2){ ?>
					<div class="xuly">
						<div id="songaykhoa">
							<button type="submit" name="unlocktaikhoan">Mở khóa tài khoản</button>
						</div>
					</div>
				<?php } ?>
				<!-- khôi phục tài khoản -->
				<?php if($rs['TrangThai'] == 3){ ?>
					<div class="xuly">
						<div id="songaykhoa">
							<button type="submit" name="hoantac">Hoàn tác</button>
						</div>
					</div>
				<?php } ?>
			</form>
		</div>
	</div>