<?php $row = mysqli_num_rows($data['listcomment']);
require_once "./mvc/models/TaiKhoanModel.php";
require_once "./mvc/models/SanPhamModel.php";
$taikhoan = new TaiKhoanModel;
$sanpham = new SanPhamModel;
?>

<div id="content-admin">
	<h1>Bình luận / <span>Danh sách</span></h1>
	<hr>
	<br>
	<div class="timkiem">
		<form>
			<div class="timkiem-tieude">
				<input type="search" name="timkiem" placeholder="Tìm kiếm">
				<button type="submit"><i class="fas fa-search"></i></button>
			</div>
		</form>
		<a onclick="checkbox()" href="./AdminDanhMucController/themdanhmuc"><i class="fas fa-trash-alt"></i>Xóa tất cả</a>
	</div>
	<br>
	<!-- thông báo lỗi -->
	<div id="thongbaoloi"><?php echo $data['noti'];?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?=$row?> bình luận</p>
		<table>
			<tr>
				<th></th>
				<th>Nội dung bình luận</th>
				<th>Người bình luận</th>
				<th>Tên sản phẩm</th>
				<th>Thao tác</th>
			</tr>
			<?php if($row > 0){
				foreach ($data['listcomment'] as $key => $comment) { ?>
					<tr>
						<td><input type="checkbox" name="checkbox" value="<?=$comment['IdBinhLuan']?>"></td>
						<td><?=$comment['NoiDung']?></td>
						<td><?=mysqli_fetch_assoc($data['list_detail_user'][$key])['HoTen']?></td>
						<td><?=mysqli_fetch_assoc($data['list_detail_product'][$key])['TenSanPham']?></td>
						<td><a onclick="return confirm('Bạn có muốn xóa không?')" href="./AdminBinhLuanController/xoabinhluan/<?=$comment['IdBinhLuan'];?>"><i class="fas fa-trash-alt"></i>Xóa</a></td>
					</tr>
			<?php } }else{ ?>
				<p>Danh sách rỗng</p>
			<?php }?>
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