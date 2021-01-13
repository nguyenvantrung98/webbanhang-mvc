<?php
	// lấy hình ảnh theo id sản phẩm
	require_once "./mvc/models/HinhAnhModel.php";
	$hinhanh = new HinhAnhModel;
?>
<div id="content-admin">
	<h1>Thể loại / <span>Thêm mới</span></h1>
	<hr>
	<br>
	<div class="content-main">
		<form id="chitietdonhang" action="" method="post" enctype="multipart/form-data">
			<label><b style="color: red">Thông tin khách hàng</b></label>
			<br><br>
			<div class="email">
				<label for="email"><b>Email</b></label>
				<div class="info-form">
					<input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['taikhoan']['TenDangNhap']?>" disabled="disabled">
				</div>
			</div>
			<br>
			<div class="hoten">
				<label for="hoten"><b>Họ tên</b></label>
				<div class="info-form">
					<input type="text" placeholder="Nhap ho ten" name="hoten" value="<?php echo $data['taikhoan']['HoTen']?>" disabled="disabled">
				</div>
			</div>
			<br>
			<div class="sodienthoai">
				<label for="sdt"><b>Số điện thoại</b></label>
				<div class="info-form">
					<input type="text" placeholder="Nhap so dien thoai" name="sdt" value="<?php echo $data['taikhoan']['SoDienThoai']?>" disabled="disabled">
				</div>
			</div>
			<br>
			<div class="diachi">
				<label for="diachi"><b>Địa chỉ</b></label>
				<div class="info-form">
					<input type="text" placeholder="Nhap dia chi" name="diachi" value="<?php echo $data['taikhoan']['DiaChi']?>" disabled="disabled">
				</div>
			</div>
			<br><br>
			<label><b style="color: red">Danh sách sản phẩm đặt mua</b></label><br><br>
			<div class="dssp-datmua">
				<table>
					<tr>
						<!-- <th>Mã đơn hàng</th> -->
						<th>Sản phẩm</th>
						<th>Số lượng</th>
						<th>Size</th>
						<th>Đơn giá</th>
						<th>Thành tiền</th>
						<th>Ngày đặt</th>
					</tr>
					<tr>
						<!-- đổ dữ liệu từ mảng gửi ra -->
						<td>
							<?php foreach($data['listdonhang_sp'] as $value){ ?>
								<!-- // từ id của sản phẩm lấy ra hình ảnh cx như tên của sp đó -->
								<div class="info-sanpham-dathang">
									<!-- từ id sản phẩm trỏ qua lấy hình , list hình nhưng lấy 1 cái đầu tiên -->
									<!-- từ id trỏ qua bảng sản phẩm lấy tên sản phẩm -->
									<img src="<?=$value['HinhAnh']?>">
									<p><?=$value['TenSanPham']?></p>
								</div>
							<?php } ?>
						</td>
						<td>
							<?php foreach($data['listdonhang_sp'] as $value){ ?>
								<div class="info-sanpham-dathang-size">
									<?=$value['SoLuongSanPham']?>
								</div>
							<?php } ?>
						</td>
						<td>
							<?php foreach($data['listdonhang_sp'] as $value){ ?>
								<div class="info-sanpham-dathang-size">
									<?php if(!$value['SizeSanPham'] == 0) echo $value['SizeSanPham']?>
								</div>
							<?php } ?>
						</td>
						<td>
							<?php
							foreach($data['listdonhang_sp'] as $key => $value){ ?>
								<div class="info-sanpham-dathang-size">
									<?=$value['DonGiaSanPham']?>
								</div>
							<?php }?>
						</td>
						<td>
							<?php foreach($data['listdonhang_sp'] as $key => $value){ ?>
								<div class="info-sanpham-dathang-size">
									<?=$value['ThanhTienSanPham']?>
								</div>
							<?php }?>
						</td>
						<td><?=$data['donhang']['ngaydat']?></td>
					</tr>
				</table>
				<br>
				<div class="tongtiendonhang">
					<b>Phí ship</b>
					<p><span>+30.000đ</span></p>
					<b>Tổng tiền</b>
					<p><span><?=$data['donhang']['TongTien'];?></span></p>
					<div></div>
					<div class="chotdon">
						<?php if($data['donhang']['TrangThai'] == 0){?>
							<button type="submit" name="chotdon">Chốt đơn</button>
						<?php }else if($data['donhang']['TrangThai'] == 1){?>
							<button type="submit" name="huydon">Hủy đơn</button>
						<?php }?>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>