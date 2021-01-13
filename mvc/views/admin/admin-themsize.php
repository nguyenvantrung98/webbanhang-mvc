<div id="content-admin">
	<h1>Size / <span>Thêm mới</span></h1>
	<hr>
	<br>
	<div class="content-main">
		<form id="formsize" action="" method="post" onsubmit="return validateForm(formsize)">
			<div class="themtaikhoan">
				<label>Chọn kiểu size</label>
				<select class="select" name="chonkieusize" id="chonkieusize">
					<option value="">Chọn kiểu size</option>
					<?php while($rs = mysqli_fetch_assoc($data["listkieusize"])){ ?>
						<option value="<?php echo $rs['IdKieuSize']?>"><?php echo $rs['TenKieuSize']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="themtaikhoan">
				<label>Tên thể loại</label>
				<input type="text" name="tensize" id="tensize" placeholder="Nhập tên size">
			</div>
			<br>
			<div id="showthongbao"><?php echo $data['tbao']?></div>
			<br>
			<div class="xuly">
				<button type="submit" name="addsize">Thêm mới</button>
				<button type="reset">Làm mới</button>
			</div>
		</form>
	</div>
</div>