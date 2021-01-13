<?php $size = mysqli_num_rows($data['listsize']);
	require_once "./mvc/models/KieuSizeModel.php";
	$sizemodel = new KieuSizeModel;
?>
<div id="content-admin">
	<h1>Size / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="text" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a href="./AdminKieuSizeController/themsize"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['tbao']?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $size?> size</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Tên size</th>
				<th>Kiểu size</th>
				<th>Ngày tạo</th>
				<th>Thao tác</th>
			</tr>
			<?php 
			if($size > 0){
				while ($rs = mysqli_fetch_assoc($data['listsize'])) { ?>
					<tr class="data" >
						<td><?php echo $rs['IdSize']?></td>
						<td><?php echo $rs['TenSize']?></td>
						<td><?php $kq = $sizemodel->getKieuSizeId($rs['IdKieuSize']);
							echo $kq['TenKieuSize']?>
						</td>
						<td><?php echo $rs['created_at']?></td>
						<td><a href="./AdminKieuSizeController/suasize/<?php echo $rs['IdSize']?>"><i class="fas fa-edit"></i>Sửa</a> | <a onclick="return confirm('Bạn có muốn xóa không?')" href="./AdminKieuSizeController/xoasize/<?php echo $rs['IdSize'];?>"><i class="fas fa-trash-alt"></i>Xóa</a></td>
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