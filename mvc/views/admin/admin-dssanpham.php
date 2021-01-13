<?php $listsanpham = mysqli_num_rows($data['listsanpham']);
	// lấy hình ảnh theo id sản phẩm
	require_once "./mvc/models/HinhAnhModel.php";
	$hinhanh = new HinhAnhModel;
?>
<div id="content-admin">
	<h1>Sản phẩm / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="search" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a href="./AdminSanPhamController/themsanpham"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['tbao'];?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $listsanpham;?> sản phẩm</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Hình ảnh</th>
				<th>Tên sản phẩm</th>
				<th>Tên thể loại</th>
				<th>Đơn giá</th>
				<th>Giảm giá (%)</th>
				<th>Số lượng</th>
				<th>Thao tác</th>
			</tr>
			<!-- all sản phẩm -->
			<?php if($listsanpham > 0){
				while ($rs = mysqli_fetch_assoc($data['listsanpham'])) { ?>
					<tr class="img-sanpham1">
						<td><?php echo $rs['IdSanPham']?></td>
						<td><img src="<?php 
								$kq = $hinhanh->getHinhAnhId($rs['IdSanPham']);
								$hinh = mysqli_fetch_assoc($kq);
								echo $hinh['src'];?>">
						</td>
						<td><?php echo $rs['TenSanPham']?></td>
						<td><?php echo $rs['IdTheLoai']?></td>
						<td><?php echo $rs['Gia']?></td>
						<td><?php echo $rs['GiamGia']?></td>
						<td><?php echo $rs['SoLuong']?></td>
						<td><a href="./AdminSanPhamController/suasanpham/<?php echo $rs['IdSanPham']?>"><i class="fas fa-edit"></i>Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="./AdminSanPhamController/xoasanpham/<?php echo $rs['IdSanPham']?>"><i class="fas fa-trash-alt"></i>Xóa</a></td>
					</tr>
				<?php }
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