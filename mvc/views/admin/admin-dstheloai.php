<!-- xử lý code -->
<?php $tl = mysqli_num_rows($data['listtheloai']);
	require_once "./mvc/models/DanhMucModel.php";
	$a = new DanhMucModel;
?>

<!-- giao diện -->
<div id="content-admin">
	<h1>Thể loại / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="search" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a href="./AdminTheLoaiController/themtheloai"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['tbao'];?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $tl; ?> thể loại</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Tên thể loại</th>
				<th>Tên không dấu</th>
				<th style="width: 20%;">Ảnh đại diện</th>
				<th>Tên Danh Mục</th>
				<th>Ngày tạo</th>
				<th>Thao tác</th>
				<!-- <th>Ten danh muc</th> -->
			</tr>
			<?php
			if($tl > 0){
				while ($rs = mysqli_fetch_assoc($data['listtheloai'])) { ?>
					<tr class="img-theloai1">
						<td><?php echo $rs['IdTheLoai']?></td>
						<td><?php echo $rs['TenTheLoai']?></td>
						<td><?php echo $rs['TenKhongDau']?></td>
						<td><img src="<?php echo $rs['AnhDaiDien']?>"></td>
						<td><?php 
							$dm = $a->getDanhMucId($rs['IdDanhMuc']);
							echo $dm['TenDanhMuc'];?>
						</td>
						<td><?php echo $rs['created_at'];?></td>
						<td><a href="./AdminTheLoaiController/suatheloai/<?php echo $rs['IdTheLoai']?>"><i class="fas fa-edit"></i>Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" href="./AdminTheLoaiController/xoatheloai/<?php echo $rs['IdTheLoai']?>"><i class="fas fa-trash-alt"></i>Xóa</a></td>
					</tr>
				<?php 	
				}
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