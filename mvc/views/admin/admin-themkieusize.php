<div id="content-admin">
	<h1>Kiểu size / <span>Thêm mới</span></h1>
	<hr>
	<br>
	<!-- <a href="admin-dsdanhmuc.php"><i class="fas fa-hand-point-left"></i></i> Quay lại</a> -->
	<br>
	<br>
	<div class="content-main">
		<form id="themDanhMuc2" action="" method="post" onsubmit="return validateForm(themDanhMuc2)">
			<label>Tên kiểu size</label>
			<br>
			<br>
			<input type="text" name="tenKieuSize" placeholder="Nhập tên kiểu size" id="tendanhmuc" onkeyup="checkForm(tendanhmuc)">
			<br>
			<br>
			<div id="showthongbao"><?php echo $data['tbao']?></div>
			<br>
			<button disabled="disabled" id="buttonDanhMuc" name="addKieuSize" type="submit">Thêm mới</button>
		</form>
	</div>
</div>