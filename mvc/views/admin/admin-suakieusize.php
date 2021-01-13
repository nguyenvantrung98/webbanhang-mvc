<div id="content-admin">
	<h1>Kiểu size / <span>Chỉnh sửa</span></h1>
	<hr>
	<br>
	<br>
	<br>
	<div class="content-main">
		<form id="themDanhMuc2" action="" method="post" onsubmit="return validateForm(themDanhMuc2)">
			<label>Tên danh mục</label>
			<br>
			<br>
			<input onkeyup="checkForm(tendanhmuc)" id="tendanhmuc" type="text" name="tenKieuSize" placeholder="Nhập tên kiểu size" value="<?php echo $data['chitietkieusize']['TenKieuSize']?>">
			<br>
			<br>
			<div id="showthongbao"><?php echo $data['tbao'];?></div>
			<br>
			<button id="buttonDanhMuc" name="updatekieusize" disabled="disabled" type="submit">Cập nhật</button>
		</form>
	</div>
</div>