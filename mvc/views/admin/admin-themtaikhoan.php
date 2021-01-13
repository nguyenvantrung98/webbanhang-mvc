<div id="content-admin">
	<h1>Tài khoản / <span>Thêm tài khoản</span></h1>
	<hr>
	<div class="content-main">
		<form id="formtaikhoan" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm(formtaikhoan)">
			<br>
			<div class="anhdaidien">
				<div>
					<img id="img1">
					<input onchange="onChange()" type="file" name="file" id="file" accept="image/*">
					<label id="label" for="file"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
				</div>
			</div>
			<div class="themtaikhoan">
				<label>Họ tên</label>
				<input type="text" name="hoTen" id="hoTen" placeholder="Nhập họ tên">
			</div>
			<div class="themtaikhoan">
				<label>Tên đăng nhập</label>
				<input type="email" name="tenDangNhap" id="tenDangNhap" placeholder="Nhập email">
			</div>
			<div class="themtaikhoan">
				<label>Mật khẩu</label>
				<input type="password" name="matKhau" id="matKhau" placeholder="Nhập mật khẩu">
			</div>
			<div class="themtaikhoan">
				<label>Số điện thoại</label>
				<input type="text" name="sdt" id="sdt" placeholder="Nhập số điện thoại">
			</div>
			<div class="themtaikhoan">
				<label>Vai trò</label>
				<select style="margin-bottom: 0;" name="vaiTro" id="vaitro">
					<option value="">Chọn vai trò</option>
					<option value="1">Quản trị</option>
					<option value="2">Người dùng</option>
				</select>
			</div>
			<div class="themtaikhoan">
				<label>Địa chỉ</label>
				<input type="text" name="diaChi" id="diaChi" placeholder="Nhập địa chỉ">
			</div>
			<div class="themtaikhoan">
				<label>Giới tính</label>
				<div class="chongioitinh">
					<input type="radio" name="gender" value="Nam">
					<label for="male">Nam</label>
					<input type="radio" name="gender" value="Nữ">
					<label for="female">Nữ</label>
					<input type="radio" name="gender" value="Khác">
					<label for="other">Khác</label>
				</div>
			</div>
			<div class="themtaikhoan">
				<label>Ngày sinh</label>
				<input type="date" name="ngaysinh">
			</div>
			<br>
			<div id="showthongbao"><?php echo $data['tbao'];?></div>
			<br>
			<div class="xuly">
				<button type="submit" name="addtaikhoan">Tạo tài khoản</button>
				<button type="reset" onclick="removeBackgroundadd()">Làm mới</button>
			</div>
		</form>
	</div>
</div>