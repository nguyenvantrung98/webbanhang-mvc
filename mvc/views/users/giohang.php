<?php 
	require_once "./mvc/models/SanPhamModel.php";
	$product = new SanPhamModel;
	require_once "./mvc/models/HinhAnhModel.php";
	$picture = new HinhAnhModel;
	// $_SESSION['sanpham'][][] = 2;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Giỏ hàng</title>
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
		<h1><i class="fas fa-shopping-cart"></i>GIỎ HÀNG 
			<span style="color: red">
				<?php if(isset($_SESSION['addCart']))
					echo count($_SESSION['addCart']). " sản phẩm";
				?>
			</span>
		</h1>
		<div style="color: red"><?=$data['noti']?></div>
		<?php if(isset($_SESSION['addCart']) && !empty($_SESSION['addCart'])){ ?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="danhsachsp-giohang">
				<table>
					<tr>
						<th></th>
						<th>Tên sản phẩm</th>
						<th>Size</th>
						<th>Số lượng</th>
						<th>Đơn giá</th>
						<th>Thành tiền</th>
						<th>Thao tác</th>
					</tr>
					<?php $id = 1;
						foreach ($_SESSION['addCart'] as $key => $value) { ?>
							<tr class="info-giohang">
								<td>
									<input onclick="checkbox(<?=$id;?>)" type="checkbox" name="checkbox[]" id="checkbox<?=$id?>" value="<?=$value['id'].$value['size']?>">
								</td>
								<td>
									<div class="tensp">
										<a href="./SanPhamController/detailproduct/<?=$value['id']?>"><img style="border-radius: 4px" src="<?= $value['image'];?>">
										</a>
										<a href="./SanPhamController/detailproduct/<?=$value['id']?>"><?= $value['nameproduct']?>
										</a>
									</div>
								</td>
								<td>
									<input readonly="readonly" type="text" name="size[]" value="<?php if(!$value['size'] == 0) echo $value['size']?>">
								</td>
								<td>
									<div class="soluong">
										<button onclick="giam(<?=$id;?>)"><i class="fas fa-minus"></i></button>
										<input readonly="readonly" type="number" name="quantity[<?=$value['id'].$value['size']?>]" id="soLuong<?=$id;?>" min="1" max="100" value="<?= $value['quantity']?>">
										<button onclick="tang(<?=$id;?>)"><i class="fas fa-plus"></i></button>
									</div>
								</td>
								<td>
									<?php if($value['sale'] == 0){?>
									<p>
										<input type="text" name="dongia<?=$id?>" id="dongia<?=$id?>" value="<?= $value['price']?>" readonly="readonly">
									</p>
									<?php }else{ //tính tiền sau khi giảm
										$price = str_replace("đ","",str_replace(".","",$value['price']));
										$new_price = (int)$price * ((100-(int)$value['sale'])/100);?>
										<p>
											<span><?=$value['price']?></span>
											<input readonly="readonly" type="text" name="dongia<?=$id?>" id="dongia<?=$id?>" value="<?= number_format($new_price,0,",",".")?>đ">
										</p>
									<?php }?>
								</td>
								<td><?php $price = str_replace("đ","",str_replace(".","",$value['price']));
									if($value['sale'] == 0){ // sp ko giảm
									$prices = ((int)$value['quantity']*(int)$price);?>
									<p>
										<input readonly="readonly" type="text" name="thanhtien<?=$id?>" id="thanhtien<?=$id?>" value="<?= number_format($prices,0,",",".")?>đ">
									</p>
									<?php }else{ //tính tiền sau khi giảm
										$new_price = (int)$price * ((100-(int)$value['sale'])/100);
										$prices = ((int)$value['quantity']*(int)$new_price);?>
										<p>
											<input readonly="readonly" type="text" name="thanhtien<?=$id?>" id="thanhtien<?=$id?>" value="<?= number_format($prices,0,",",".")?>đ">
										</p>
									<?php }?>
								</td>
								<td title="Xóa" class="xoa">
									<a href="./GioHangController/delete/<?=$value['id']?>/<?=$value['size']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')">
										<i class="far fa-trash-alt"></i>
									</a>
								</td>
							</tr>
					<?php $id++;} ?>
				</table>
			</div>
			<div class="thanhtoan">
				<div class="tongthanhtoan">
					<label><b>Tổng tiền</b></label>
						<input style="color: red" type="text" name="total_money" id="tongtien" 
						value="0đ" readonly="readonly">
				</div>
				<hr>
				<div class="dathang">
					<button type="submit" name="order">Mua hàng</button>
				</div>
			</div>
		</form>
		<?php } else {?> <div class="giohang_empty">
			<img src = './public/img/footer/logo1.png'>
			<h1>Giỏ hàng trống</h1>
			<a href="./HomeController/home">MUA NGAY</a>
		</div> <?php }?>
	</section>

	<?php include("footer.php")?>

</body>
<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
<script src="./public/js/scripts.js"></script>
<script src="./public/js/showFormGopy.js"></script>
<script src="./public/js/giohang.js"></script>
</html>