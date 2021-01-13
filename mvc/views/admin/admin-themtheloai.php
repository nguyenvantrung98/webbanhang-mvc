<div id="content-admin">
	<h1>Thể loại / <span>Thêm mới</span></h1>
	<hr>
	<br>
	<div class="content-main">
		<form id="formtheloai" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm(formtheloai)">
			<div class="anhdaidien">
				<div>
					<img id="img1" name="img1">
					<input onchange="onChange()" type="file" name="file" id="file" accept="image/*">
					<label style="opacity: 1" id="label" for="file"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
				</div>
			</div>
			<div class="themtaikhoan">
				<label>Chọn danh mục</label>
				<select class="select" name="chondanhmuc" id="chondanhmuc">
					<option value="">Chọn danh mục</option>
					<?php while ($rs = mysqli_fetch_assoc($data['listdanhmuc'])) { ?>
						<option value="<?php echo $rs['IdDanhMuc'];?>"><?php echo $rs['TenDanhMuc']?></option>
						<?php
					}?>
				</select>
			</div>
			<div class="themtaikhoan">
				<label>Tên thể loại</label>
				<input type="text" name="tenTheLoai" id="tenTheLoai" placeholder="Nhập tên danh mục">
			</div>
			<br>
			<div id="showthongbao"><?php echo $data['tbao'];?></div>
			<br>
			<div class="xuly">
				<button type="submit" name="themtheloai">Thêm mới</button>
				<button type="reset" onclick="removeBackgroundadd()">Làm mới</button>
			</div>
		</form>
	</div>
</div>