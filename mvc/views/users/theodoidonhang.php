<!DOCTYPE html>
<html>
<head>
	<title>Theo dõi đơn hàng</title>
	<meta charset="UTF-8">
	<meta name="mota" content="Danh sách sản phẩm">
	<base href="http://localhost/webbanhang-mvc/HomeController">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<link rel="stylesheet" href="./public/vendors/css/grid.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="./public/img/footer/logo1.png"/>
	<meta name="tukhoa" content="Quan-ao,Giay-dep,Phu-kien">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="tacgia" content="Nguyễn Văn Trung">
</head>
<body>
	<?php include("./mvc/views/users/header.php")?>
	
	<section class="giohang" id="main">
		<h1><i class="fas fa-shopping-cart"></i>ĐƠN HÀNG CỦA BẠN</h1>
		<?php 
			$count = mysqli_num_rows($data['listOrder']);
			if($count > 0){ ?>
				<form>
					<div class="danhsachsp-giohang">
						<table>
							<tr>
								<th>Tên sản phẩm</th>
								<th>Size</th>
								<th>Số lượng</th>
								<th>Đơn giá</th>
								<th>Thành tiền</th>
								<th>Tổng thanh toán</th>
								<th>Ngày đặt</th>
								<th>Trạng thái</th>
							</tr>
							<?php foreach ($data['listOrder'] as $key => $values){?>
							<tr class="info-giohang">
								<td>
									<?php foreach ($data['listOrder_Product'][$key] as $value){?>
									<div class="info-sanpham-dathang">
										<a href="./SanPhamController/detailproduct/<?=$value['IdSanPham']?>">
											<img src="<?=$value['HinhAnh']?>">
										</a>
										<p>
											<a style="text-decoration: none" href="./SanPhamController/detailproduct/<?=$value['IdSanPham']?>"><?=$value['TenSanPham']?>
											</a>
										</p>
									</div>
									<?php }?>
								</td>
								<td>
									<?php foreach ($data['listOrder_Product'][$key] as $value){?>
									<div class="info-sanpham-dathang-size">
										<?php if(!$value['SizeSanPham'] == 0){
											echo $value['SizeSanPham'];
										}?>
									</div>
									<?php }?>
								</td>
								<td>
									<?php foreach ($data['listOrder_Product'][$key] as $value){?>
									<div class="info-sanpham-dathang-size">
										<?=$value['SoLuongSanPham']?>
									</div>
									<?php }?>
								</td>
								<td>
									<?php foreach ($data['listOrder_Product'][$key] as $value){?>
									<div class="info-sanpham-dathang-size">
										<p><?=$value['DonGiaSanPham']?></p>
									</div>
									<?php }?>
								</td>
								<td>
									<?php foreach ($data['listOrder_Product'][$key] as $value){?>
									<div class="info-sanpham-dathang-size">
										<p><?=$value['ThanhTienSanPham']?></p>
									</div>
									<?php }?>
								</td>
								<td>
									<div class="info-sanpham-dathang-size">
										<p><?=$values['TongTien']?></p>
									</div>
								</td>
								<td>
									<div class="info-sanpham-dathang-size">
										<p><?=$values['ngaydat']?></p>
									</div>
								</td>
								<td class="trangthai">
									<div class="trangthai-donhang">	
									<?php if($values['TrangThai'] == 0){?>
										<p>Chờ chốt đơn</p>
										<a onclick="return confirm('Bạn có chắc chắn muốn hủy không?')" href="./DonHangController/cancel_order/<?=$values['IdDonHang']?>">Hủy</a>
									<?php }elseif($values['TrangThai'] == 1){?>
										<p>Đang giao hàng</p>
										<a onclick="return confirm('Bạn đã nhận được hàng?')" href="./DonHangController/confirm_order/<?=$values['IdDonHang']?>">Đã nhận hàng</a>
									<?php }?>
									</div>
								</td>
							</tr>
							<?php }?>
						</table>
					</div>
				</form>
		<?php }else{?>
			<div class="giohang_empty">
				<img src = './public/img/footer/logo1.png'>
				<h1>Đơn hàng trống</h1>
				<a href="./HomeController/home">MUA NGAY</a>
			</div> 
		<?php }?>
		<br><br><br>
		<h1><i class="fas fa-stopwatch"></i>ĐƠN HÀNG GẦN ĐÂY</h1>
		<div class="danhsachsp-giohang">
			<?php 
			$count = mysqli_num_rows($data['listOrdered']);
			if($count > 0){ ?>
			<table>
				<tr>
					<th>Tên sản phẩm</th>
					<th>Size</th>
					<th>Số lượng</th>
					<th>Đơn giá</th>
					<th>Thành tiền</th>
					<th>Tổng thanh toán</th>
					<th>Ngày nhận</th>
					<th>Trạng thái</th>
				</tr>
				<?php foreach ($data['listOrdered'] as $key => $values){?>
				<tr class="info-giohang">
					<td>
						<?php foreach ($data['listOrdered_Product'][$key] as $value){?>
							<div class="info-sanpham-dathang">
								<a href="./SanPhamController/detailproduct/<?=$value['sanpham_IdSanPham']?>"><img src="<?=$value['HinhAnh']?>">
								</a>
								<p>
									<a style="text-decoration: none" href="./SanPhamController/detailproduct/<?=$value['sanpham_IdSanPham']?>"><?=$value['TenSanPham']?>
									</a>
								</p>
							</div>
						<?php }?>
					</td>
					<td>
						<?php foreach ($data['listOrdered_Product'][$key] as $value){?>
							<div class="info-sanpham-dathang-size">
								<?php if(!$value['SizeSanPham'] == 0){
									echo $value['SizeSanPham'];
								}?>
							</div>
						<?php }?>
					</td>
					<td>
						<?php foreach ($data['listOrdered_Product'][$key] as $value){?>
							<div class="info-sanpham-dathang-size">
								<?=$value['SoLuongSanPham']?>
							</div>
						<?php }?>
					</td>
					<td>
						<?php foreach ($data['listOrdered_Product'][$key] as $value){?>
							<div class="info-sanpham-dathang-size">
								<p><?=$value['DonGiaSanPham']?></p>
							</div>
						<?php }?>
					</td>
					<td>
						<?php foreach ($data['listOrdered_Product'][$key] as $value){?>
							<div class="info-sanpham-dathang-size">
								<p><?=$value['ThanhTienSanPham']?></p>
							</div>
						<?php }?>
					</td>
					<td>
						<div class="info-sanpham-dathang-size">
							<p><?=$values['TongTien']?></p>
						</div>
					</td>
					<td>
						<div class="info-sanpham-dathang-size">
							<p><?=$values['ngaydat']?></p>
						</div>
					</td>
					<td>Đã nhận hàng</td>
				</tr>
				<?php }?>
			</table>
			<?php }else{?>
				<div class="giohang_empty">
					<img style="width: auto;height: 150px" src = './public/img/footer/logo1.png'>
					<h1>Đơn hàng trống</h1>
					<a href="./HomeController/home">MUA NGAY</a>
				</div> 
			<?php }?>
		</div>
	</section>
	
	<?php include("./mvc/views/users/footer.php")?>
	
</body>
<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
<script src="./public/js/scripts.js"></script>
<script src="./public/js/showFormGopy.js"></script>
</html>