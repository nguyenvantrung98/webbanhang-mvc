<?php $taikhoan = mysqli_num_rows($data['listtaikhoan'])?>
<div id="content-admin">
	<h1>Tài khoản / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="search" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a href="./AdminTaiKhoanController/themtaikhoan/add"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['tbao'];?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $taikhoan;?> tài khoản</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Ảnh đại diện</th>
				<th>Họ tên</th>
				<th>Email</th>
				<th>Vai trò</th>
				<th>Trạng thái</th>
				<th>Thao tác</th>
			</tr>
			<?php if($taikhoan > 0){
				while($rs = mysqli_fetch_assoc($data['listtaikhoan'])){ ?>
					<tr class="taikhoan">
						<td><?php echo $rs['IdUser']?></td>
						<td><img src="<?php echo $rs['AnhDaiDien']?>"></td>
						<td><?php echo $rs['HoTen']?></td>
						<td><?php echo $rs['TenDangNhap']?></td>
						<td><?php echo $rs['VaiTro']?></td>
						<td><?php if($rs['TrangThai'] == 0) echo "Chưa kích hoạt";
						else if($rs['TrangThai'] == 1) echo "Đã kích hoạt"; 
						else if($rs['TrangThai'] == 2) echo "Đang khóa";
						else if($rs['TrangThai'] == 3) echo "Đã xóa";
						?></td>
						<td><a href="./AdminTaiKhoanController/xemtaikhoan/<?php echo $rs['IdUser'];?>"><i class="fas fa-eye"></i>Xem</a> <?php if($rs['TrangThai'] != 3){ ?> | <a onclick="return confirm('Bạn có muốn xóa không?')" href="./AdminTaiKhoanController/xoataikhoan/<?php echo $rs['IdUser'];?>/xoatam"><i class="fas fa-trash-alt"></i>Xóa</a><?php } ?> </td>
					</tr>
				<?php	}
				}
			?>
		</table>
		<div class="pagination">
			<a href="#">&laquo;</a>
			<a href="#">1</a>
			<a href="#">2</a>
			<a href="#">3</a>
			<a href="#">4</a>
			<a href="#">5</a>
			<a href="#">6</a>
			<a href="#">&raquo;</a>
		</div>
	</div>
</div>