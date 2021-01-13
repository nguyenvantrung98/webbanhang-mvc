
<!-- giao diện -->
<div id="content-admin">
	<h1>Thể loại / <span>Chỉnh sửa</span></h1>
	<hr>
	<br>
	<div class="content-main">
		<form id="formtheloai" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm(formtheloai)">
			<div class="anhdaidien">
				<div>
					<img id="img1" name="img1" src="<?php echo $data["theloai"]["AnhDaiDien"]?>">
					<input onchange="onChange()" type="file" name="file" id="file" accept="image/*">
					<label style="opacity: 0.2" id="label" for="file"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
				</div>
			</div>
			<div class="themtaikhoan">
				<label>Chọn danh mục</label>
				<select class="select" name="chondanhmuc" id="chondanhmuc">
					<!-- đếm danh sách danh mục và in ra từng cái -->
					<?php if(($row = mysqli_num_rows($data['listdanhmuc'])) > 0){
						while ($rs = mysqli_fetch_assoc($data['listdanhmuc'])) { ?>
							<option <?php if($data['theloai']['IdDanhMuc'] == $rs['IdDanhMuc']) echo "selected = 'selected'"?> value="<?php echo $rs['IdDanhMuc']?>">
								<?php echo $rs['TenDanhMuc']?>
							</option>
					<?php }
						}
					?>
				</select>
			</div>
			<div class="themtaikhoan">
				<label>Tên thể loại</label>
				<input type="text" name="tenTheLoai" id="tenTheLoai" placeholder="Nhập tên danh mục" value="<?php echo $data["theloai"]["TenTheLoai"]?>">
			</div>
			<br>
			<div id="showthongbao"><?php echo $data['tbao'];?></div>
			<br>
			<div class="xuly">
				<button type="submit" name="updatetheloai">Cập nhật</button>
				<button type="reset" onclick="removeBackgroundupdate()">Làm mới</button>
			</div>
		</form>
	</div>
</div>