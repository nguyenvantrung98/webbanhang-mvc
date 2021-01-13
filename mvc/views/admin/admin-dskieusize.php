<?php $ks = mysqli_num_rows($data['listkieusize']);?>
<div id="content-admin">
	<h1>Kiểu size / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="text" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a href="./AdminKieuSizeController/themkieusize"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['tbao']?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $ks ?> kiểu size</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Tên kiểu size</th>
				<th>Ngày tạo</th>
				<th>Thao tác</th>
			</tr>
			<?php 
			if($ks > 0){
				while ($rs = mysqli_fetch_assoc($data['listkieusize'])) { ?>
					<tr class="data" >
						<td><?php echo $rs['IdKieuSize']?></td>
						<td><?php echo $rs['TenKieuSize']?></td>
						<td><?php echo $rs['created_at']?></td>
						<td><a href="./AdminKieuSizeController/suakieusize/<?php echo $rs['IdKieuSize']?>"><i class="fas fa-edit"></i>Sửa</a> | <a onclick="return confirm('Bạn có muốn xóa không?')" href="./AdminKieuSizeController/xoakieusize/<?php echo $rs['IdKieuSize'];?>"><i class="fas fa-trash-alt"></i>Xóa</a></td>
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