<?php
$row = mysqli_num_rows($data['listdonhang']);
require_once "./mvc/models/TaiKhoanModel.php";
$taikhoan = new TaiKhoanModel;
require_once "./mvc/models/SanPhamModel.php";
$sanpham = new SanPhamModel;

?>

<div id="content-admin">
	<h1>Đơn hàng / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="search" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['tbao'];?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $row; ?> đơn hàng</p>
		<table>
			<tr>
				<th style="width: 5%">Id</th>
				<th>Họ tên</th>
				<th>Số điện thoại</th>
				<th>Địa chỉ</th>
				<th>Trạng thái</th>
				<th>Thao tác</th>
			</tr>
			<?php if($row > 0){
				while ($rs = mysqli_fetch_assoc($data['listdonhang'])) { 
					// từ id user ta lấy ra thông tin của user đó
					$kq = $taikhoan->getTaiKhoanId($rs['IdUser']);
					$rs1 = mysqli_fetch_assoc($kq);
					?>
					<tr>
						<td><?php echo $rs['IdDonHang']?></td>
						<td><?php echo $rs1['HoTen']?></td>
						<td><?php echo $rs1['SoDienThoai']?></td>
						<td><?php echo $rs1['DiaChi']?></td>
						<td><?php if($rs['TrangThai'] == 0)
							echo "Chờ giao hàng";
							if($rs['TrangThai'] == 1)
								echo "Đang giao";
							if($rs['TrangThai'] == 3)
								echo "Đã hủy đơn";
							if($rs['TrangThai'] == 2)
								echo "Đã nhận hàng";
						?>
					</td>
					<td>
						<?php if($rs['TrangThai'] == 0 || $rs['TrangThai'] == 1){?>
							<a href="./AdminDonHangController/xemdonhang/<?=$rs['IdDonHang']?>">
							<i class="fas fa-eye"></i>Xem</a>
							| <a href="./AdminDonHangController/xemdonhang/<?=$rs['IdDonHang']?>">
							<i class="fas fa-calendar-times"></i>Hủy</a>
						<?php }elseif($rs['TrangThai'] == 2 || $rs['TrangThai'] == 3){?>
							<a href="./AdminDonHangController/xemdonhang/<?=$rs['IdDonHang']?>">
							<i class="fas fa-eye"></i>Xem</a>
							| <a onclick="return confirm('Bạn có chắc chắn xóa không?')" href="./AdminDonHangController/xoadonhang/<?=$rs['IdDonHang']?>">
							<i class="fas fa-trash-alt"></i>Xóa</a>
						<?php }?>
					</td>
				</tr>
			<?php }
		}?>
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