<?php $dm = mysqli_num_rows($data['listdanhmuc']);?>

<div id="content-admin">
	<h1>Danh mục / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="text" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a href="./AdminDanhMucController/themdanhmuc"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['tbao'];?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $dm; ?> danh mục</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Tên danh mục</th>
				<th>Tên không dấu</th>
				<th>Ngày tạo</th>
				<!-- <th>Ngày sửa</th> -->
				<th>Thao tác</th>
			</tr>
			<?php 
			if($dm > 0){
				while ($rs = mysqli_fetch_assoc($data['listdanhmuc'])) { ?>
					<tr class="data" >
						<td><?php echo $rs['IdDanhMuc']?></td>
						<td><?php echo $rs['TenDanhMuc']?></td>
						<td><?php echo $rs['TenKhongDau']?></td>
						<td><?php echo $rs['created_at']?></td>
						<td><a href="./AdminDanhMucController/suadanhmuc/<?php echo $rs['IdDanhMuc']?>"><i class="fas fa-edit"></i>Sửa</a> | <a onclick="return confirm('Bạn có muốn xóa không?')" href="./AdminDanhMucController/xoadanhmuc/<?php echo $rs['IdDanhMuc'];?>"><i class="fas fa-trash-alt"></i>Xóa</a>
						</td>
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