<!-- content -->
<div id="content-admin">
	<h1>Danh mục / <span>Thêm mới</span></h1>
	<hr>
	<br>
	<br>
	<br>
	<div class="content-main">
		<form id="themDanhMuc2" action="./AdminDanhMucController/themdanhmuc" method="post" onsubmit="return validateForm(themDanhMuc2)">
			<label>Tên danh mục</label>
			<br>
			<br>
			<input type="text" name="tenDanhMuc" placeholder="Nhập tên danh mục" id="tendanhmuc" onkeyup="checkForm(tendanhmuc)">
			<br>
			<br>
			<div id="showthongbao"><?=$data['tbao'];?></div>
			<br>
			<button id="buttonDanhMuc" name="buttonDanhMuc" type="submit">Thêm mới</button>
		</form>
	</div>
</div>
