
<div id="content-admin">
	<h1>Danh mục / <span>Chỉnh sửa</span></h1>
	<hr>
	<br>
	<br>
	<br>
	<div class="content-main">
		<form id="themDanhMuc2" action="AdminDanhMucController/suadanhmuc/<?php echo $data['chitietdanhmuc']['IdDanhMuc'];?>" method="post" onsubmit="return validateForm(themDanhMuc2)">
			<label>Tên danh mục</label>
			<br>
			<br>
			<input onkeyup="checkForm(tendanhmuc)" id="tendanhmuc" type="text" name="tenDanhMuc" placeholder="Nhập tên danh mục" value="<?php echo $data['chitietdanhmuc']['TenDanhMuc'];?>">
			<br>
			<br>
			<div id="showthongbao"><?php echo $data['tbao'];?></div>
			<br>
			<button id="buttonDanhMuc" name="buttonDanhMuc" disabled="disabled" type="submit">Cập nhật</button>
		</form>
	</div>
</div>