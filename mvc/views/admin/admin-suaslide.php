<div id="content-admin">
	<h1>Slide / <span>Chỉnh sửa</span></h1>
	<hr>
	<br>
	<div class="content-main">
		<form id="formSlide" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm(formSlide)">
			<label>Tên slide</label>
			<br><br>
			<input type="text" name="tenSlide" id="tenSlide" placeholder="Nhập tên slide" value="<?php echo $data['chitietslide']['TenSlide'];?>">
			<br><br>
			<label>Chọn ảnh</label>
			<br><br>
			<div id="img-slide">
				<img id="img1" src="<?php echo $data['chitietslide']['Hinh'];?>">
				<input onchange="onChange()" type="file" name="file" id="file" accept="image/*">
				<label style="opacity: 0.2" id="label" for="file"><i class="fas fa-folder-plus"></i><br>Nhấn chọn ảnh</label>
			</div>
			<br><br>
			<div id="showthongbao"><?php echo $data['tbao']?></div>
			<br>
			<div class="xuly">
				<button type="submit" name="updateslide">Chỉnh sửa</button>
				<button type="reset" onclick="removeBackgroundupdate()">Làm mới</button>
			</div>
		</form>
	</div>
</div>