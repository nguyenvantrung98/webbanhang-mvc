<?php $row = mysqli_num_rows($data['listcontact']);
	require_once "./mvc/models/TaiKhoanModel.php";
	$taikhoan = new TaiKhoanModel;
?>
<div id="content-admin">
	<h1>Góp ý & Phản hồi / <span>Danh sách</span></h1>
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
	<div id="thongbaoloi"><?php echo $data['noti'];?></div>
	<br>
	<div class="content-main">
		<p><span>Số lượng : </span><?=$row?> phản hồi</p>
		<table>
			<tr>
				<th>Id</th>
				<th>Họ tên</th>
				<th>Email</th>
				<th>Số điện thoại</th>
				<th>Nội dung</th>
				<th>Thao tác</th>
			</tr>
			<?php if($row > 0){
				foreach ($data['listcontact'] as $key => $contact) { 
					$info_user = mysqli_fetch_assoc($data['list_detail_user'][$key]);?>
					<tr>
						<td><input type="checkbox" name="checkbox" value="<?=$contact['IdPhanHoi']?>"></td>
						<td><?=$info_user['HoTen']?></td>
						<td><?=$info_user['TenDangNhap']?></td>
						<td><?=$info_user['SoDienThoai']?></td>
						<td><?=$contact['NoiDung']?></td>
						<td><a onclick="return confirm('Bạn có muốn xóa không?')" href="./AdminGopYController/delete_contact/<?=$contact['IdPhanHoi']?>"><i class="fas fa-trash-alt"></i>Xóa</a></td>
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