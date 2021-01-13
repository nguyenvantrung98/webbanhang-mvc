<!DOCTYPE html>
<html>
<head>
	<title>Đặt hàng</title>
	<meta charset="UTF-8">
	<meta name="mota" content="Danh sách sản phẩm">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<base href="http://localhost/webbanhang-mvc/HomeController">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<link rel="stylesheet" href="./public/vendors/css/grid.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="./public/img/footer/logo1.png"/>
	<meta name="tukhoa" content="Quan-ao,Giay-dep,Phu-kien">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="tacgia" content="Nguyễn Văn Trung">
</head>
<body>
	<?php include("header.php")?>
	
	<section class="giohang" id="main">
		<div class="diachinhanhang">
			<h1><i class="fas fa-map-marker-alt"></i>ĐỊA CHỈ NHẬN HÀNG</h1>
			<div class="info-nguoinhan">
				<p><?=$_SESSION['infouser']['username']?></p>
				<p><?=$_SESSION['infouser']['phone']?></p>
				<p><?=$_SESSION['infouser']['address']?></p>
				<p><a href="./HomeController/infouser/update_product_cart">Thay đổi</a></p>
			</div>
		</div>
		<h1><i class="fas fa-shopping-cart"></i>
			SẢN PHẨM <span style="color: red"><?= count($_SESSION['order_product'])?> sản phẩm</span>
		</h1>
		<form method="post">
			<div class="danhsachsp-dathang">
				<table>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Size</th>
						<th>Đơn giá</th>
						<th>Số lượng</th>
						<th>Thành tiền</th>
					</tr>
					<?php 
					if(isset($_SESSION['order_product'])){ 
						foreach ($_SESSION['order_product'] as $key => $value) { ?>
							<tr class="info-dathang">
								<td>
									<div class="tensp-dathang">
										<a><img style="border-radius: 4px;" src="<?=$value['image']?>"></a>
										<p><?=$value['nameproduct']?></p>
									</div>
								</td>
								<td>
									<?php if(!$value['size'] == 0){?>
										<p><?=$value['size']?></p>
									<?php }?>
								</td>
								<td>
									<?php if($value['sale'] == 0){?>
									<p>
										<input type="text" name="dongia<?=$id?>" id="dongia<?=$id?>" value="<?= $value['price']?>" disabled="disabled">
									</p>
									<?php }else{ //tính tiền sau khi giảm
										$price = str_replace("đ","",str_replace(".","",$value['price']));
										$new_price = (int)$price * ((100-(int)$value['sale'])/100);?>
										<p>
											<span><?=$value['price']?></span>
											<input disabled="disabled" type="text" name="dongia<?=$id?>" id="dongia<?=$id?>" value="<?= number_format($new_price,0,",",".")?>đ">
										</p>
									<?php }?>
								</td>
								<td><?=$value['quantity']?></td>
								<td>
									<p><?php $price = str_replace("đ","",str_replace(".","",$value['price']));
									if($value['sale'] == 0){ // sp ko giảm
										$prices = ((int)$value['quantity']*(int)$price);?>
									<p>
										<input disabled="disabled" type="text" name="thanhtien<?=$id?>" id="thanhtien<?=$id?>" value="<?= number_format($prices,0,",",".")?>đ">
									</p>
									<?php }else{ //tính tiền sau khi giảm
										$new_price = (int)$price * ((100-(int)$value['sale'])/100);
										$prices = ((int)$value['quantity']*(int)$new_price);?>
										<p>
											<input disabled="disabled" type="text" name="thanhtien<?=$id?>" id="thanhtien<?=$id?>" value="<?= number_format($prices,0,",",".")?>đ">
										</p>
									<?php }?></p>
								</td>
							</tr>
					<?php } } 
					else{
						echo "Chưa có sản phẩm";
					}?>
				</table>
			</div>
			<div class="thanhtoan">
				<p>+30.000đ</p>
				<div class="tongthanhtoan">
					<label>Tổng tiền</label>
					<span>
						<?php 
							$price = str_replace("đ","",str_replace(".","",$_SESSION['total_money']));
							echo number_format((int)$price+30000,0,",",".")."đ";
						?>
					</span>
				</div>
				<hr>
				<div class="dathang-thanhtoan">
					<div class="phuongthucthanhtoan">
						<p>Phương thức thanh toán </p>
						<span>
							<p> Thanh toán khi nhận hàng</p>
						</span>
					</div>
					<div class="dathang">
						<button type="submit" name="order_product">Đặt hàng</button>
					</div>
				</div>
			</div>
		</form>
	</section>
	
	<?php include("footer.php")?>
	
	<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
	<script src="./public/js/scripts.js"></script>
	<script src="./public/js/showFormGopy.js"></script>
</body>

</html>