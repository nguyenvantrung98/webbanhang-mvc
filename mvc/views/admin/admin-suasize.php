<div id="content-admin">
	<h1>Size / <span>Chỉnh sửa</span></h1>
	<hr>
	<br>
	<div class="content-main">
		<form id="formsize" action="" method="post" onsubmit="return validateForm(formsize)">
			<div class="themtaikhoan">
				<label>Chọn kiểu size</label>
				<select class="select" name="chonkieusize" id="chonkieusize">
					<option value="">Chọn kiểu size</option>
					<?php while($rs = mysqli_fetch_assoc($data["listkieusize"])){ ?>
						<option <?php if($data['chitietsize']['IdKieuSize'] == $rs['IdKieuSize']) echo "selected ='selected';"?> value="<?php echo $rs['IdKieuSize']?>"><?php echo $rs['TenKieuSize']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="themtaikhoan">
				<label>Tên size</label>
				<input type="text" name="tensize" id="tensize" placeholder="Nhập tên size" value="<?php echo $data['chitietsize']['TenSize']?>">
			</div>
			<br>
			<div id="showthongbao"><?php echo $data['tbao'];?></div>
			<br>
			<div class="xuly">
				<button type="submit" name="addsize">Cập nhật</button>
				<button type="reset">Làm mới</button>
			</div>
		</form>
	</div>
</div>