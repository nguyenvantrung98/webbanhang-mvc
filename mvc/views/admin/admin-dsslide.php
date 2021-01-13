<?php $slide = mysqli_num_rows($data['listslide']);?>
<div id="content-admin">
	<h1>Slide / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="search" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a href="./AdminSlideController/themslide"><i class="fas fa-plus"></i>Thêm mới</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?=$data['tbao']?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?php echo $slide?> slide</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Tên slide</th>
				<th style="width: 450px">Hình</th>
				<th>Ngày tạo</th>
				<th>Thao tác</th>
				<!-- <th>Ten danh muc</th> -->
			</tr>
			<?php if($slide > 0){
				while ($rs = mysqli_fetch_assoc($data['listslide'])) { ?>
					<tr class="slide1">
						<td><?php echo $rs['IdSlide'];?></td>
						<td><?php echo $rs['TenSlide'];?></td>
						<td><img src="<?=$rs['Hinh'];?>"></td>
						<td><?php echo $rs['created_at'];?></td>
						<td><a href="./AdminSlideController/suaslide/<?php echo $rs['IdSlide'];?>"><i class="fas fa-edit"></i>Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="./AdminSlideController/xoaslide/<?php echo $rs['IdSlide'];?>"><i class="fas fa-trash-alt"></i>Xóa</a></td>
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