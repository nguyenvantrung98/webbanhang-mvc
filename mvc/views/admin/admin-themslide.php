<div id="content-admin">
	<h1>Slide / <span>Thêm mới</span></h1>
	<hr>
	<br>
	<div class="content-main">
		<form id="formSlide" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm(formSlide)">
			<label>Tên slide</label>
			<br><br>
			<input type="text" name="tenSlide" id="tenSlide" placeholder="Nhập tên slide">
			<br><br>
			<label>Chọn ảnh</label>
			<br><br>
			<div id="img-slide">
				<img id="img1">
				<input onchange="onChange()" type="file" name="file" id="file" accept="image/*">
				<label id="label" for="file"><i class="fas fa-folder-plus"></i><br>Nhấn chọn ảnh</label>
			</div>
			<br><br>
			<div id="showthongbao"><?php echo $data['tbao']?></div>
			<br>
			<div class="xuly">
				<button type="submit" name="addslide">Thêm mới</button>
				<button type="reset" onclick="removeBackgroundadd()">Làm mới</button>
			</div>
		</form>
	</div>
</div>